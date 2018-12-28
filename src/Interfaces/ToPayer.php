<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 18:57
 */

namespace Louisk\BoletoFacil\Interfaces;


use Louisk\BoletoFacil\Resources\PayerResource;

interface ToPayer
{
    public function toPayer(): PayerResource;
}
