<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 01.12.2018
 * Time: 20:19
 */

class reHitError extends Exception
{
    protected $name = "reHitError";
    protected $message = "Невозможно разместить корабль в этой позиции";
    protected $code = 2;
}