<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 18:00
 */

namespace Louisk\BoletoFacil\Resources;


class PaymentCreditCardResource extends PaymentResource
{
    public function __construct(
        $reference,
        string $description,
        float $amount,
        PayerResource $payerResource,
        CreditCardResource $creditCardResource
    ) {
        parent::__construct($reference, $description, $amount, $payerResource, self::PAYMENT_TYPE_CREDIT_CARD);

        $this->creditCard = $creditCardResource;
    }

    public function toArray(): array
    {
        $data = parent::toArray();

        return array_merge($data, $this->creditCard->toArray());
    }
}
