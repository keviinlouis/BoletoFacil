<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 20:01
 */

namespace Louisk\BoletoFacil\Responses;


class Response
{
    /**
     * @var bool
     */
    protected $success;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var string|null
     */
    protected $errorMessage;

    public function __construct(string $json)
    {
        $data = json_decode($json, true);

        $this->success = isset($data['success']) ? (bool) $data['success'] : false;

        $this->data = isset($data['data']) ? $data['data'] : [];

        $this->errorMessage = isset($data['errorMessage']) ? $data['errorMessage'] : null;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
}
