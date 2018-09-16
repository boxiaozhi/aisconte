<?php
/**
 * Created by PhpStorm.
 * User: Conte
 * Date: 2018/8/17
 * Time: 17:12
 */

namespace App\Exceptions;


use Throwable;

class CException extends \Exception
{
    function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}