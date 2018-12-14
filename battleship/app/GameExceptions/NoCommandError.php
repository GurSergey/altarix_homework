<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 13.12.2018
 * Time: 18:58
 */
namespace app\GameExceptions;

class NoCommandError extends GameException
{
    protected $name = "NoCommandError";
    protected $message = "Нет такой команды";
    protected $code = 4;
}