<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 21:21
 */

namespace app\GameExceptions;


class SessionTypeError extends GameException
{
    protected $name = "SessionTypeError";
    protected $message = "Неизвестный тип сессии";
    protected $code = 10;
}