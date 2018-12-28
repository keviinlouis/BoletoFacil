<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 20:06
 */

namespace Louisk\BoletoFacil\Resources;


class ChargeResponse
{
    /**
     * @var int
     */
    protected $code;

    /**
     * @var mixed
     */
    protected $reference;
    /**
     * @var string
     */
    protected $dueDate;
    /**
     * @var string
     */
    protected $checkoutUrl;
    /**
     * @var string
     */
    protected $link;
    /**
     * @var string
     */
    protected $installmentLink;
    /**
     * @var string
     */
    protected $payNumber;
    /**
     * @var BilletDetailsResponse
     */
    protected $billetDetails;

    /**
     * @var array
     */
    protected $payments;

    public function __construct(
        int $code,
        $reference,
        string $dueDate,
        string $checkoutUrl = null,
        string $link = null,
        string $installmentLink = null,
        string $payNumber = null
    ) {
        $this->code = $code;

        $this->reference = $reference;

        $this->dueDate = $dueDate;

        $this->checkoutUrl = $checkoutUrl;

        $this->link = $link;

        $this->installmentLink = $installmentLink;

        $this->payNumber = $payNumber;

    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    /**
     * @return string
     */
    public function getCheckoutUrl(): string
    {
        return $this->checkoutUrl;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getInstallmentLink(): string
    {
        return $this->installmentLink;
    }

    /**
     * @return string
     */
    public function getPayNumber(): string
    {
        return $this->payNumber;
    }

    /**
     * @return array
     */
    public function getBilletDetails(): BilletDetailsResponse
    {
        return $this->billetDetails;
    }

    /**
     * @param BilletDetailsResponse $billetDetails
     * @return ChargeResponse
     */
    public function setBilletDetails(BilletDetailsResponse $billetDetails): ChargeResponse
    {
        $this->billetDetails = $billetDetails;
        return $this;
    }

    /**
     * @return array|PaymentResponse[]
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
     * @param array $payments
     * @return ChargeResponse
     */
    public function setPayments(array $payments)
    {
        $this->payments = $payments;
        return $this;
    }

    /**
     * @param PaymentResponse $paymentResponse
     * @return $this
     */
    public function addPayment(PaymentResponse $paymentResponse)
    {
        $this->payments[] = $paymentResponse;
        return $this;
    }
}
