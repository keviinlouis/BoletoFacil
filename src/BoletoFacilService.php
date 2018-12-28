<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 12:14
 */

namespace Louisk\BoletoFacil;


use Louisk\BoletoFacil\Interfaces\ToPayment;
use Louisk\BoletoFacil\Interfaces\ToPaymentBoleto;
use Louisk\BoletoFacil\Interfaces\ToPaymentCreditCard;
use Louisk\BoletoFacil\Requests\PaymentRequest;
use Louisk\BoletoFacil\Resources\AuthResource;
use Louisk\BoletoFacil\Resources\PayerResource;
use Louisk\BoletoFacil\Resources\PaymentBoletoResource;

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

       $request->create($payment->toBoleto());

    }

    public function makePaymentCreditCard(ToPaymentCreditCard $payment)
    {
        $request = new PaymentRequest($this->auth);

        $request->create($payment->toPaymentCreditCard());
    }

    public function get()
    {

    }

    public function registerWebHook()
    {

    }
}
