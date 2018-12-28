<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 20:06
 */

namespace Louisk\BoletoFacil\Resources;


class PaymentResponse
{

    /**
     * Pagamento autorizado (Aguardando confirmação)
     */
    const AUTHORIZED = 'AUTHORIZED';

    /**
     * Pagamento rejeitado pela análise de risco.
     */
    const DECLINED = 'DECLINED';

    /**
     * Pagamento não realizado
     */
    const FAILED = 'FAILED';

    /**
     * Pagamento não autorizado pela instituição responsável pelo cartão de crédito
     */
    const NOT_AUTHORIZED = 'NOT_AUTHORIZED';

    /**
     *    Pagamento confirmado
     */
    const CONFIRMED = 'CONFIRMED';

    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $amount;
    /**
     * @var string
     */
    protected $date;
    /**
     * @var string
     */
    protected $fee;
    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    protected $status;
    /**
     * @var string
     */
    protected $creditCardId;

    /**
     * @var ChargeResponse
     */
    protected $charge;


    /**
     * @param int $id
     * @param string $amount
     * @param string $date
     * @param string $fee
     * @param string $type
     * @param string $status
     * @param string $creditCardId
     */

    public function __construct(
        int $id,
        string $amount,
        string $date,
        string $fee,
        string $type,
        string $status = null,
        string $creditCardId = null
    ) {
        $this->id = $id;
        $this->amount = $amount;
        $this->date = $date;
        $this->fee = $fee;
        $this->type = $type;
        $this->status = $status;
        $this->creditCardId = $creditCardId;
    }

    /**
     * @param ChargeResponse $charge
     * @return PaymentResponse
     */
    public function setCharge(ChargeResponse $charge): PaymentResponse
    {
        $this->charge = $charge;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getFee(): string
    {
        return $this->fee;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getCreditCardId(): string
    {
        return $this->creditCardId;
    }

    /**
     * @param $status
     * @return bool
     */
    private function isStatus($status): bool
    {
        return $this->status == $status;
    }

    /**
     * @return bool
     */
    public function isAuthorized(): bool
    {
        return $this->isStatus(self::AUTHORIZED);
    }

    /**
     * @return bool
     */
    public function isDeclined(): bool
    {
        return $this->isStatus(self::DECLINED);
    }

    /**
     * @return bool
     */
    public function isFailed(): bool
    {
        return $this->isStatus(self::FAILED);
    }

    /**
     * @return bool
     */
    public function isNotAuthorized(): bool
    {
        return $this->isStatus(self::NOT_AUTHORIZED);
    }

    /**
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return $this->isStatus(self::CONFIRMED);
    }
}
