<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 18:57
 */

namespace Louisk\BoletoFacil\Interfaces;


use Louisk\BoletoFacil\Resources\CreditCardResource;

interface ToCreditCard
{
    public function toCreditCard(): CreditCardResource;

    public function saveCreditCardId($id): void;
}
