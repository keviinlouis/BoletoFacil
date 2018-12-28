<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-21
 * Time: 17:05
 */

namespace App\BoletoFacil\Requests;


use App\BoletoFacil\Request;
use App\BoletoFacil\Responses\FetchBalanceResponse;
use App\BoletoFacil\Responses\Response;

class AccountRequest extends Request
{
    const FETCH_BALANCE = 'fetch-balance';
    const REQUEST_TRANSFER = 'request-transfer';

    /**
     * @return FetchBalanceResponse
     */
    public function fetchBalance(): FetchBalanceResponse
    {
        $response = $this->send(self::FETCH_BALANCE);

        if(!$response->isSuccess()){
            //TODO Verificar falha
        }

        return new FetchBalanceResponse($response);
    }

    /**
     * @param float $amount
     * @return Response
     */
    public function requestTransfer(float $amount): Response
    {
        $response = $this->send(self::REQUEST_TRANSFER, ['amount' => $amount]);

        if(!$response->isSuccess()){
            //TODO Verificar falha
        }

        return $response;
    }
}
