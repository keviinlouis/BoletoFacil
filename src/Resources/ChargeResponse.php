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
     * @var array
     */
    protected $billetDetails;

    public function __construct(
        int $code,
        $reference,
        string $dueDate,
        string $checkoutUrl,
        string $link,
        string $installmentLink,
        string $payNumber,
        BilletDetailsResponse $billetDetails = null
    ) {
        $this->code = $code;

        $this->reference = $reference;

        $this->dueDate = $dueDate;

        $this->checkoutUrl = $checkoutUrl;

        $this->link = $link;

        $this->installmentLink = $installmentLink;

        $this->payNumber = $payNumber;

        $this->billetDetails = $billetDetails;
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
    public function getBilletDetails(): array
    {
        return $this->billetDetails;
    }
}
