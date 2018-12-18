<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 16.12.2018
 * Time: 12:28
 */

namespace app\GameExceptions;


class CountShipsError extends GameException
{
    protected $name = "CountShipsError";
    protected $message = "Количество кораблей не соответсвует правилам";
    protected $code = 8;
}