<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 19:01
 */

namespace App\BoletoFacil\Interfaces;


interface ToPayment
{
    public function savePaymentId($id): void;
}
