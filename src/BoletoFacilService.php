<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 12:14
 */

namespace App\BoletoFacil;


use App\BoletoFacil\Interfaces\ToPayment;
use App\BoletoFacil\Interfaces\ToPaymentBoleto;
use App\BoletoFacil\Interfaces\ToPaymentCreditCard;
use App\BoletoFacil\Requests\PaymentRequest;
use App\BoletoFacil\Resources\AuthResource;
use App\BoletoFacil\Resources\PayerResource;
use App\BoletoFacil\Resources\PaymentBoletoResource;

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
