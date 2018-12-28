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

class CreatePaymentResponse
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

        foreach ($this->data['charges'] as $charge) {
            $billetDetails = null;

            if(isset($charge['billetDetails'])) {
                $billetDetails = new BilletDetailsResponse(
                    $charge['billetDetails']['bankAccount'],
                    $charge['billetDetails']['ourNumber'],
                    $charge['billetDetails']['barcodeNumber'],
                    $charge['billetDetails']['portfolio']
                );
            }

            $this->charges[] = new ChargeResponse(
                $charge['code'],
                $charge['reference'],
                $charge['dueDate'],
                $charge['checkoutUrl'],
                $charge['link'],
                $charge['installmentLink'],
                $charge['payNumber'],
                $billetDetails
            );
        }

        if(isset($this->data['payments'])){
            $this->isTransparentCheckout = true;
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
