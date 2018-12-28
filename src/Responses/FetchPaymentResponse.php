<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 20:05
 */

namespace App\BoletoFacil\Responses;


use App\BoletoFacil\Resources\BilletDetailsResponse;
use App\BoletoFacil\Resources\ChargeResponse;
use App\BoletoFacil\Resources\PaymentResponse;

class FetchPaymentResponse
{
    /**
     * @var Response
     */
    protected $response;

    /**
     * @var ChargeResponse[]
     */
    protected $charges;

    /**
     * @var PaymentResponse[]
     */
    protected $payments;

    /**
     * @var bool
     */
    protected $isTransparentCheckout;

    /**
     * @var array
     */
    private $data;

    public function __construct(Response $response)
    {
        $this->response = $response;

        $this->data = $response->getData();

        $this->charges = [];
        $this->payments = [];

        foreach ($this->data['payments'] as $payment) {
            $this->payments[] = new PaymentResponse(
                $payment['id'],
                $payment['amount'],
                $payment['date'],
                $payment['fee'],
                $payment['type'],
                $payment['status'],
                $payment['creditCardId']
            );
        }

    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->response->isSuccess();
    }

    /**
     * @return ChargeResponse[]
     */
    public function getCharges(): array
    {
        return $this->charges;
    }

    /**
     * @return ChargeResponse|null
     */
    public function getCharge(): ?ChargeResponse
    {
        return reset($this->charges);
    }

    /**
     * @return PaymentResponse[]
     */
    public function getPayments(): array
    {
        return $this->payments;
    }

    /**
     * @return bool
     */
    public function isTransparentCheckout(): bool
    {
        return $this->isTransparentCheckout;
    }
}
