<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 12:36
 */

namespace Louisk\BoletoFacil\Resources;


use Louisk\BoletoFacil\Exceptions\DescriptionTooLargeException;
use Louisk\BoletoFacil\Exceptions\InvalidAmountException;
use Louisk\BoletoFacil\Exceptions\InvalidDiscountAmountException;
use Louisk\BoletoFacil\Exceptions\InvalidDiscountDaysException;
use Louisk\BoletoFacil\Exceptions\InvalidFineException;
use Louisk\BoletoFacil\Exceptions\InvalidInterestException;
use Louisk\BoletoFacil\Exceptions\InvalidMaxOverdueDaysException;
use Louisk\BoletoFacil\Exceptions\ReferenceTooLargeException;
use Louisk\BoletoFacil\Interfaces\Arrayable;
use Carbon\Carbon;

abstract class PaymentResource implements Arrayable
{
    const PAYMENT_TYPE_BOLETO = 'BOLETO';
    const PAYMENT_TYPE_CREDIT_CARD = 'CREDIT_CARD';

    /**
     * @var int|string
     */
    protected $reference;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var PayerResource
     */
    protected $payerResource;

    /**
     * @var string
     */
    protected $paymentTypes;

    /**
     * @var int|null
     */
    protected $installments;

    /**
     * @var string|null
     */
    protected $dueDate;

    /**
     * @var int|null
     */
    protected $maxOverdueDays;
    /**
     * @var float|null
     */
    protected $fine;

    /**
     * @var float|null
     */
    protected $interest;

    /**
     * @var int|null
     */
    protected $discountDays;

    /**
     * @var float|null
     */
    protected $discountAmount;

    /**
     * @var CreditCardResource
     */
    protected $creditCard;

    /**
     * @var string
     */
    protected $notificationUrl;

    /**
     * BoletoResource constructor.
     * @param int|string $reference
     * @param string $description
     * @param float $amount
     * @param PayerResource $payerResource
     * @param string $paymentTypes
     * @throws DescriptionTooLargeException
     * @throws InvalidAmountException
     * @throws ReferenceTooLargeException
     */
    public function __construct(
        $reference,
        string $description,
        float $amount,
        PayerResource $payerResource,
        string $paymentTypes
    ) {
        if(strlen($reference) > 255) {
            throw new ReferenceTooLargeException();
        }

        if(strlen($description) > 400) {
            throw new DescriptionTooLargeException();
        }

        if($amount < 2.30 || $amount > 1000000) {
            throw new InvalidAmountException();
        }

        $this->reference = $reference;

        $this->description = $description;

        $this->amount = $amount;

        $this->payerResource = $payerResource;

        $this->paymentTypes = $paymentTypes;
    }

    /**
     * Número de parcelas da cobrança
     * Se igual a 1, será gerado um boleto simples, se 2 ou mais, será gerado um carnê
     *
     * @param int $installments
     * @return PaymentResource
     */
    public function setInstallments(int $installments): self
    {
        $this->installments = $installments;

        return $this;
    }

    /**
     * Data de vencimento do boleto ou da primeira parcela, no caso de cobrança parcelada
     * Para parcelamento as prestações terão vencimento com 1 mês de intervalo, a partir da data informada
     *
     * @param Carbon $dueDate
     * @return PaymentResource
     */
    public function setDueDate(Carbon $dueDate): self
    {
        $this->dueDate = $dueDate->format('dd/mm/aaaa');

        return $this;
    }

    /**
     * Número máximo de dias que o boleto poderá ser pago após o vencimento
     * Zero significa que o boleto não poderá ser pago após o vencimento
     *
     * @param int $maxOverdueDays
     * @return PaymentResource
     * @throws InvalidMaxOverdueDaysException
     */
    public function setMaxOverdueDays(int $maxOverdueDays): self
    {
        if($maxOverdueDays < 0 || $maxOverdueDays > 29) {
            throw new InvalidMaxOverdueDaysException();
        }

        $this->maxOverdueDays = $maxOverdueDays;

        return $this;
    }

    /**
     * Multa para pagamento após o vencimento
     * Só é efetivo se maxOverdueDays for maior que zero
     * @param float $fine
     * @return PaymentResource
     * @throws InvalidFineException
     */
    public function setFine(float $fine): self
    {
        if($fine < 0.00 || $fine > 20.00) {
            throw new InvalidFineException();
        }

        if($this->maxOverdueDays <= 0) {
            trigger_error('Fine só será valido se MaxOverdueDays for maior que zero', E_USER_WARNING);
        }

        $this->fine = $fine;

        return $this;
    }

    /**
     * Juro mensal para pagamento após o vencimento
     * Só é efetivo se maxOverdueDays for maior que zero
     * @param float $interest
     * @return PaymentResource
     * @throws InvalidInterestException
     */
    public function setInterest(float $interest): self
    {
        if($interest < 0.00 || $interest > 20.00) {
            throw new InvalidInterestException();
        }

        if($this->maxOverdueDays <= 0) {
            trigger_error('Interest só será valido se MaxOverdueDays for maior que zero', E_USER_WARNING);
        }

        $this->interest = $interest;

        return $this;
    }

    /**
     * Valor do desconto
     * @param float $discountAmount
     * @return PaymentResource
     * @throws InvalidDiscountAmountException
     */
    public function setDiscountAmount(float $discountAmount): self
    {
        if($discountAmount < 0.00) {
            throw new InvalidDiscountAmountException();
        }
        $this->discountAmount = $discountAmount;

        return $this;
    }

    /**
     * Dias concessão de desconto para pagamento antecipado. Exemplo: Até 10 dias antes do vencimento.
     * Padrão: -1
     * Se caso for -1, não terá vencimento para o desconto
     * Se caso for 0, significa conceder desconto até a data do vencimento
     * @param int $discountDays
     * @return PaymentResource
     * @throws InvalidDiscountDaysException
     */
    public function setDiscountDays(int $discountDays): self
    {
        if($discountDays < 0.00) {
            throw new InvalidDiscountDaysException();
        }

        $this->discountDays = $discountDays;

        return $this;
    }

    /**
     * @param string $notificationUrl
     * @return PaymentResource
     */
    public function setNotificationUrl(string $notificationUrl): PaymentResource
    {
        $this->notificationUrl = $notificationUrl;
        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'reference' => $this->reference,
            'description' => $this->description,
            'amount' => $this->amount,
            'paymentTypes' => $this->paymentTypes,
            'installments' => $this->installments,
            'dueDate' => $this->dueDate,
            'maxOverdueDays' => $this->maxOverdueDays,
            'fine' => $this->fine,
            'interest' => $this->interest,
            'discountDays' => $this->discountDays,
            'discountAmount' => $this->discountAmount,
            'notificationUrl' => $this->notificationUrl
        ];

        return array_merge(
            array_filter($data, function($item){
                return !is_null($item);
            }),
            $this->payerResource->toArray()
        );
    }
}
