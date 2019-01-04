<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 12:14
 */

namespace Louisk\BoletoFacil;


use Louisk\BoletoFacil\Interfaces\ToPaymentBoleto;
use Louisk\BoletoFacil\Interfaces\ToPaymentCreditCard;
use Louisk\BoletoFacil\Requests\PaymentRequest;
use Louisk\BoletoFacil\Resources\AuthResource;
use Louisk\BoletoFacil\Responses\FetchPaymentResponse;

class BoletoFacilService
{
    /**
     * @var AuthResource
     */
    private $auth;

    /**
     * BoletoFacilService constructor.
     * @param AuthResource $authResource
     */
    public function __construct(AuthResource $authResource)
    {
        $this->auth = $authResource;
    }

    /**
     * @param ToPaymentBoleto $payment
     * @throws Exceptions\MissingNotificationUrlException
     */
    public function makePaymentBoleto(ToPaymentBoleto $payment)
    {
       $request = new PaymentRequest($this->auth);

       $response = $request->create($payment->toBoleto());

       $payment->savePaymentId($response->getCharge()->getCode());

       $payment->saveBoletoData($response->getCharge());

    }

    /**
     * @param ToPaymentCreditCard $payment
     * @throws Exceptions\MissingNotificationUrlException
     */
    public function makePaymentCreditCard(ToPaymentCreditCard $payment)
    {
        $request = new PaymentRequest($this->auth);

        $response = $request->create($payment->toPaymentCreditCard());

        $payment->savePaymentId($response->getCharge()->getCode());
    }

    /**
     * @param string $paymentToken
     * @return FetchPaymentResponse
     */
    public function getPayment(string $paymentToken): FetchPaymentResponse
    {
        $request = new PaymentRequest($this->auth);

        $response = $request->fetch($paymentToken);

        return $response;
    }

    public function cancelPayment(string $code)
    {
        $request = new PaymentRequest($this->auth);
        
        $response = $request->cancel($code);
        
        return $response;
    }
}
