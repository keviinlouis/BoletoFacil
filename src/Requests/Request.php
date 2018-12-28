<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 12:14
 */

namespace Louisk\BoletoFacil;


use Louisk\BoletoFacil\Resources\AuthResource;
use Louisk\BoletoFacil\Responses\Response;
use GuzzleHttp\Client;
use function GuzzleHttp\Psr7\build_query;

class Request
{
    const STATUS_NOT_VALID = 400;
    const STATUS_CREATED = 200;

    const BASE_URL_PRODUCTION = 'https://www.boletobancario.com';
    const BASE_URL_SANDBOX = 'https://sandbox.boletobancario.com';
    const BASE_URI = 'boletofacil/integration/api/v1';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var AuthResource
     */
    protected $auth;

    /**
     * Request constructor.
     * @param AuthResource $authResource
     */
    public function __construct(AuthResource $authResource)
    {
        $this->client = new Client();
        $this->auth = $authResource;
    }

    private function makeHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    private function makeBody(array $data)
    {
        return (
            array_merge([
                'token' => $this->auth->getToken(),
                'responseType' => 'JSON'
            ],
            $data)
        );
    }

    private function makeUrl($url): string
    {
        $urlArray = [
            $this->auth->isSandbox() ? self::BASE_URL_SANDBOX : self::BASE_URL_PRODUCTION,
            self::BASE_URI,
            $url,
        ];

        return implode('/', $urlArray);
    }

    protected function send($url, array $data = [])
    {
        $response = $this->client->get(
            $this->makeUrl($url) . '?' .build_query($this->makeBody($data)),
            [
                'headers' => $this->makeHeaders(),
            ]
        );

        return new Response($response->getBody()->getContents());
    }
}
