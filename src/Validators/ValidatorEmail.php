<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-19
 * Time: 13:56
 */

namespace Louisk\BoletoFacil\Validators;


use Louisk\BoletoFacil\Exceptions\InvalidEmailException;

class ValidatorEmail
{
    /**
     * @param $email
     * @throws InvalidEmailException
     */
    public static function valida($email)
    {
        if(strlen($email) > 80 || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new InvalidEmailException();
        }
    }
}
