<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 02.12.2018
 * Time: 15:59
 */

abstract class GameException extends Exception
{
    protected $name = "Error";
    protected $message = "Error";
    protected $code = 0;
    public function getName()
    {
        return $this->name;
    }

}