<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 16.12.2018
 * Time: 11:25
 */

namespace app\GameExceptions;


use Throwable;

class MaxSizeShipError extends GameException
{
    protected $name = "MaxSizeShipError";
    protected $message = "Превышен максимальный размер корабля допустимый правилами. Координаты начала корабля ";
    protected $code = 6;
    public function __construct(int $x, int $y)
    {
        $this->message .= $x . ' ' . $y;
    }
}