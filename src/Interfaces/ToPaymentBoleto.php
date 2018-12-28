<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 18:57
 */

namespace Louisk\BoletoFacil\Interfaces;


use Louisk\BoletoFacil\Resources\ChargeResponse;
use Louisk\BoletoFacil\Resources\PaymentBoletoResource;

interface ToPaymentBoleto extends ToPayment
{
    public function toBoleto(): PaymentBoletoResource;

    public function saveBoletoData(ChargeResponse $chargeResponse);
}
