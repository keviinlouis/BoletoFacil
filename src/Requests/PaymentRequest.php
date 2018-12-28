<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 19:34
 */

namespace Louisk\BoletoFacil\Requests;


use Louisk\BoletoFacil\Queries\ListPaymentsQuery;
use Louisk\BoletoFacil\Request;
use Louisk\BoletoFacil\Resources\PaymentResource;
use Louisk\BoletoFacil\Responses\CreatePaymentResponse;
use Louisk\BoletoFacil\Responses\FetchPaymentResponse;
use Louisk\BoletoFacil\Responses\ListPaymentsResponse;
use Louisk\BoletoFacil\Responses\Response;

class PaymentRequest extends Request
{
    const ISSUE_CHARGE = 'issue-charge';
    const FETCH_PAYMENT_DETAILS = 'fetch-payment-details';
    const LIST_PAYMENTS = 'list-charges';
    const CANCEL_CHARGE = 'cancel-charge';

    /**
     * @param PaymentResource $paymentResource
     * @return CreatePaymentResponse
     * @throws \Louisk\BoletoFacil\Exceptions\MissingNotificationUrlException
     */
    public function create(PaymentResource $paymentResource): CreatePaymentResponse
    {
        $data = $paymentResource->toArray();

        if(!isset($data['notificationUrl'])){
            $data['notificationUrl'] = $this->auth->getNotificationUrl();
        }

        $response = $this->send(self::ISSUE_CHARGE, $data);

        if(!$response->isSuccess()){
            //TODO verificar falha
        }

        return new CreatePaymentResponse($response);
    }

    public function fetch($paymentToken): FetchPaymentResponse
    {
        $data = ['paymentToken' => $paymentToken];

        $response = $this->send(self::FETCH_PAYMENT_DETAILS, $data);

        if(!$response->isSuccess()){
            //TODO verificar falha
        }

        return new FetchPaymentResponse($response);
    }

    public function list(ListPaymentsQuery $listPaymentsQuery): ListPaymentsResponse
    {
        $response = $this->send(self::LIST_PAYMENTS, $listPaymentsQuery->toArray());

        if(!$response->isSuccess()){
            //TODO verificar falha
        }

        return new ListPaymentsResponse($response);
    }

    public function cancel($code): Response
    {
        $response = $this->send(self::CANCEL_CHARGE, ['code' => $code]);

        if(!$response->isSuccess()){
            //TODO verificar falha
        }

        return $response;
    }
}
