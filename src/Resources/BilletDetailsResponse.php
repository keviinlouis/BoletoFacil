<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 20:10
 */

namespace Louisk\BoletoFacil\Resources;


class BilletDetailsResponse
{
    protected $bankAccount;
    protected $ourNumber;
    protected $barcodeNumber;
    protected $portfolio;

    public function __construct($bankAccount, $ourNumber, $barcodeNumber, $portfolio)
    {
        $this->bankAccount = $bankAccount;
        $this->ourNumber = $ourNumber;
        $this->barcodeNumber = $barcodeNumber;
        $this->portfolio = $portfolio;
    }
}
