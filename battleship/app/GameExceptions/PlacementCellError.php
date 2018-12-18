<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 16.12.2018
 * Time: 11:46
 */

namespace app\GameExceptions;


class PlacementCellError extends GameException
{
    protected $name = "PlacementCellError";
    protected $message = "Размещение ячейки корабля не возможно. Координаты ";
    protected $code = 7;
    public function __construct(int $x, int $y)
    {
        $this->message .= $x . ' ' . $y;
    }
}