<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-21
 * Time: 17:08
 */

namespace Louisk\BoletoFacil\Responses;


class FetchBalanceResponse
{
    /**
     * @var float
     */
    private $balance;

    /**
     * @var float
     */
    private $withheldBalance;

    /**
     * @var float
     */
    private $transferableBalance;

    public function __construct(Response $response)
    {
        $data = $response->getData();

        $this->balance = (float) $data['balance'];
        $this->withheldBalance = (float) $data['withheldBalance'];
        $this->transferableBalance = (float) $data['transferableBalance'];
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @return float
     */
    public function getWithheldBalance(): float
    {
        return $this->withheldBalance;
    }

    /**
     * @return float
     */
    public function getTransferableBalance(): float
    {
        return $this->transferableBalance;
    }


}
