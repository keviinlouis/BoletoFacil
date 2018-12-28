<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-21
 * Time: 16:18
 */

namespace Louisk\BoletoFacil\Resources;


use Louisk\BoletoFacil\Exceptions\MissingNotificationUrlException;

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
    /**
     * @var string
     */
    protected $notificationUrl;

    /**
     * AuthResource constructor.
     * @param string $token
     * @param bool $sandbox
     * @param string $notificationUrl
     */
    public function __construct(string $token, bool $sandbox, string $notificationUrl)
    {
        $this->token = $token;
        $this->sandbox = $sandbox;
        $this->notificationUrl = $notificationUrl;
    }

    /**
     * @return bool
     */
    public function isSandbox(): bool
    {
        return $this->sandbox;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string
     * @throws MissingNotificationUrlException
     */
    public function getNotificationUrl(): string
    {
        if(empty($this->notificationUrl)){
            throw new MissingNotificationUrlException();
        }

        return $this->notificationUrl;
    }
}
