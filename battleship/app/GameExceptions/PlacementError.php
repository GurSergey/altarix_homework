<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 12.11.2018
 * Time: 16:22
 */
namespace app\GameExceptions;

class PlacementError extends GameException
{
    protected $name = "PlacementError";
    protected $message = "Невозможно разместить корабль в этой позиции";
    protected $code = 1;


}