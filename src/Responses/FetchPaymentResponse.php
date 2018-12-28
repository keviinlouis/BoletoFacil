<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 20:05
 */

namespace Louisk\BoletoFacil\Responses;


use Louisk\BoletoFacil\Resources\ChargeResponse;
use Louisk\BoletoFacil\Resources\PaymentResponse;

class FetchPaymentResponse
{
    /**
     * @var Response
     */
    protected $response;

    /**
     * @var PaymentResponse
     */
    protected $payment;

    /**
     * @var array
     */
    private $data;

    public function __construct(Response $response)
    {
        $this->response = $response;

        $this->data = $response->getData();

        $payment = $this->data['payment'];

        $this->payment = new PaymentResponse(
            $payment['id'],
            $payment['amount'],
            $payment['date'],
            $payment['fee'],
            $payment['type'],
            $payment['status']
        );

        $charge = $payment['charge'];

        $this->payment->setCharge(new ChargeResponse(
            $charge['code'],
            $charge['reference'],
            $charge['dueDate']
        ));

    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->response->isSuccess();
    }

    /**
     * @return PaymentResponse
     */
    public function getPayment(): PaymentResponse
    {
        return $this->payment;
    }
}
