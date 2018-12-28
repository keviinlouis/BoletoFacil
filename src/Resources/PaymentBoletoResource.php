<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 18:00
 */

namespace Louisk\BoletoFacil\Resources;


class PaymentBoletoResource extends PaymentResource
{
    public function __construct(
        $reference,
        string $description,
        float $amount,
        PayerResource $payerResource
    ) {
        parent::__construct($reference, $description, $amount, $payerResource, self::PAYMENT_TYPE_BOLETO);
    }
}
