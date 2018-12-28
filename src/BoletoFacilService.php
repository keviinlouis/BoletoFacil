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

class BoletoFacilService
{
    /**
     * @var AuthResource
     */
    private $auth;

    public function __construct(AuthResource $authResource)
    {
        $this->auth = $authResource;
    }

    /**
     * @param ToPaymentBoleto $payment
     */
    public function makePaymentBoleto(ToPaymentBoleto $payment)
    {
       $request = new PaymentRequest($this->auth);

       $response = $request->create($payment->toBoleto());

       $payment->savePaymentId($response->getCharge()->getCode());

       $payment->saveBoletoData($response->getCharge());

    }

    public function makePaymentCreditCard(ToPaymentCreditCard $payment)
    {
        $request = new PaymentRequest($this->auth);

        $response = $request->create($payment->toPaymentCreditCard());

        $payment->savePaymentId($response->getCharge()->getCode());
    }

    public function get()
    {

    }

    public function registerWebHook()
    {

    }
}
