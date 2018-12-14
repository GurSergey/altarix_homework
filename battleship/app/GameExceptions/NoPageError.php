<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 13.12.2018
 * Time: 18:58
 */
namespace app\GameExceptions;

class NoPageError extends GameException
{
    protected $name = "NoPageError";
    protected $message = "Невозможно найти страницу";
    protected $code = 3;
}