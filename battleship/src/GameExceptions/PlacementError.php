<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 12.11.2018
 * Time: 16:22
 */
class PlacementError extends Exception
{

    protected $message = "Невозможно разместить корабль в этой позиции";
    protected $code = 1;


}