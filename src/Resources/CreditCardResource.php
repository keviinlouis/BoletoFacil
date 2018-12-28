<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 18:03
 */

namespace Louisk\BoletoFacil\Resources;


use Louisk\BoletoFacil\Interfaces\Arrayable;

class CreditCardResource implements Arrayable
{
    /**
     * @var string
     */
    protected $creditCardHash;
    /**
     * @var bool
     */
    protected $creditCardStore;
    /**
     * @var string
     */
    protected $creditCardId;

    /**
     * CreditCardResource constructor.
     * @param string $creditCardHash
     * @param string|null $creditCardId
     * @param bool $creditCardStore
     */
    public function __construct(string $creditCardHash, string $creditCardId = null, bool $creditCardStore = true)
    {
        $this->creditCardHash = $creditCardHash;
        $this->creditCardStore = $creditCardStore;
        $this->creditCardId = $creditCardId;
    }

    public function toArray(): array
    {
        return array_filter([
            'creditCardHash' => $this->creditCardHash,
            'creditCardStore' => $this->creditCardStore,
            'creditCardId' => $this->creditCardId,
        ], function($item){
            return !is_null($item);
        });
    }
}
