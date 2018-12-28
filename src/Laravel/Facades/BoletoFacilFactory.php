<?php
/**
 * Created by PhpStorm.
 * User: DevMaker BackEnd
 * Date: 01/06/2018
 * Time: 12:23
 */

namespace Louisk\BoletoFacil\Laravel\Facades;

use Illuminate\Support\Facades\Facade as BaseFacade;

class BoletoFacilFactory extends BaseFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'boleto-facil';
    }
}
