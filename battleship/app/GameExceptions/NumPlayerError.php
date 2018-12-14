<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 14.12.2018
 * Time: 10:40
 */

namespace app\GameExceptions;


class NumPlayerError extends GameException
{
    protected $name = "NumPlayerError";
    protected $message = "Нет такого номера игрока";
    protected $code = 5;
}