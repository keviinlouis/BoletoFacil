<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 13:01
 */

namespace Louisk\BoletoFacil\Resources;


use Louisk\BoletoFacil\Exceptions\InvalidPayerDocumentException;
use Louisk\BoletoFacil\Interfaces\Arrayable;
use Louisk\BoletoFacil\Validators\ValidatorCPFCNPJ;
use Louisk\BoletoFacil\Validators\ValidatorEmail;
use Carbon\Carbon;

class PayerResource implements Arrayable
{

    protected $payerName;
    protected $payerCpfCnpj;
    protected $payerEmail;
    protected $payerSecondaryEmail;
    protected $payerPhone;
    protected $payerBirthDate;
    protected $notifyPayer;

    /**
     * PayerResource constructor.
     * @param string $payerName
     * @param string $payerCpfCnpj
     * @throws InvalidPayerDocumentException
     */
    public function __construct(string $payerName, string $payerCpfCnpj)
    {
        $validator = new ValidatorCPFCNPJ($payerCpfCnpj);

        if(!$validator->valida()) {
            throw new InvalidPayerDocumentException();
        }

        $this->payerName = $payerName;
        $this->payerCpfCnpj = $validator->getValue();
    }

    /**
     * Endereço de email do comprador
     *
     * @param string $payerEmail
     * @return PayerResource
     * @throws \Louisk\BoletoFacil\Exceptions\InvalidEmailException
     */
    public function setPayerEmail(string $payerEmail): self
    {
        ValidatorEmail::valida($payerEmail);

        $this->payerEmail = $payerEmail;

        return $this;
    }

    /**
     * Endereço de email secundário do comprador
     *
     * @param string $payerSecondaryEmail
     * @return PayerResource
     * @throws \Louisk\BoletoFacil\Exceptions\InvalidEmailException
     */
    public function setPayerSecondaryEmail(string $payerSecondaryEmail): self
    {
        ValidatorEmail::valida($payerSecondaryEmail);

        $this->payerSecondaryEmail = $payerSecondaryEmail;

        return $this;
    }

    /**
     * Telefone do comprador
     *
     * @param string $payerPhone
     * @return PayerResource
     */
    public function setPayerPhone(string $payerPhone): self
    {
        $this->payerPhone = $payerPhone;

        return $this;
    }

    /**
     * Data de nascimento do comprador
     *
     * @param Carbon $payerBirthDate
     * @return PayerResource
     */
    public function setPayerBirthDate(Carbon $payerBirthDate): self
    {
        $this->payerBirthDate = $payerBirthDate->format('dd/mm/aaaa');

        return $this;
    }

    /**
     * Define se o Boleto Fácil enviará emails de notificação sobre esta cobrança para o comprador
     * O email com o boleto ou carnê só será enviado ao comprador se este parâmetro for igual a true e o endereço de email do comprador estiver presente
     * O lembrete de vencimento só será enviado se as condições acima forem verdadeiras e se na configuração do Favorecido os lembretes estiverem ativados
     *
     * @param bool $notifyPayer
     * @return PayerResource
     */
    public function notifyPayer(bool $notifyPayer = true): self
    {
        if(strlen($this->payerEmail) <= 0) {
            trigger_error('A notificação só será enviada quando o email do pagador estiver presente', E_USER_WARNING);
        }

        $this->notifyPayer = $notifyPayer;

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'payerName' => $this->payerName,
            'payerCpfCnpj' => $this->payerCpfCnpj,
            'payerEmail' => $this->payerEmail,
            'payerSecondaryEmail' => $this->payerSecondaryEmail,
            'payerPhone' => $this->payerPhone,
            'payerBirthDate' => $this->payerBirthDate,
            'notifyPayer' => $this->notifyPayer,
        ];

        return array_filter($data, function($item){
           return !is_null($item);
        });
    }
}


