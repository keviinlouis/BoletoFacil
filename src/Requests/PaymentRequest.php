<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 19:34
 */

namespace App\BoletoFacil\Requests;


use App\BoletoFacil\Request;
use App\BoletoFacil\Resources\PaymentBoletoResource;
use App\BoletoFacil\Resources\PaymentResource;
use App\BoletoFacil\Responses\CreatePaymentResponse;
use App\BoletoFacil\Responses\FetchPaymentResponse;

class PaymentRequest extends Request
{
    const ISSUE_CHARGE = 'issue-charge';
    const FETCH_PAYMENT_DETAILS = 'fetch-payment-details';

    /**
     * @param PaymentResource $paymentBoletoResource
     * @return CreatePaymentResponse
     */
    public function create(PaymentResource $paymentBoletoResource): CreatePaymentResponse
    {
        $response = $this->send(self::ISSUE_CHARGE, $paymentBoletoResource);

        if(!$response->isSuccess()){
            //TODO verificar falha
        }

        return new CreatePaymentResponse($response);
    }

    public function fetch($paymentToken)
    {
        $response = $this->send(self::FETCH_PAYMENT_DETAILS, ['paymentToken' => $paymentToken]);

        if(!$response->isSuccess()){
            //TODO verificar falha
        }

        return new FetchPaymentResponse($response);
    }
}
