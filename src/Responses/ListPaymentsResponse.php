<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-28
 * Time: 15:37
 */

namespace Louisk\BoletoFacil\Responses;


use Louisk\BoletoFacil\Resources\ChargeResponse;
use Louisk\BoletoFacil\Resources\PaymentResponse;

class ListPaymentsResponse
{
    private $response;
    private $data;
    private $charges;

    public function __construct(Response $response)
    {
        $this->response = $response;

        $this->data = $response->getData();

        $this->charges = [];

        foreach ($this->data['charges'] as $charge) {
            $chargeResponse = new ChargeResponse(
                $charge['code'],
                $charge['reference'],
                $charge['dueDate'],
                $charge['checkoutUrl'],
                $charge['link'],
                $charge['installmentLink'],
                $charge['payNumber']
            );
            foreach ($this->data['payments'] as $payment) {
                $chargeResponse->addPayment(new PaymentResponse(
                    $payment['id'],
                    $payment['amount'],
                    $payment['date'],
                    $payment['fee'],
                    $payment['type'],
                    $payment['status']
                ));
            }
        }
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @return array|ChargeResponse[]
     */
    public function getCharges(): array
    {
        return $this->charges;
    }
}
