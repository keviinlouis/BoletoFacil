<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-21
 * Time: 16:18
 */

namespace Louisk\BoletoFacil\Resources;


class AuthResource
{
    /**
     * @var string
     */
    protected $token;
    /**
     * @var bool
     */
    protected $sandbox;

    public function __construct(string $token, bool $sandbox, string $webHook)
    {
        $this->token = $token;
        $this->sandbox = $sandbox;
    }

    public function isSandbox()
    {
        return $this->sandbox;
    }

    public function getToken()
    {
        return $this->token;
    }
}
