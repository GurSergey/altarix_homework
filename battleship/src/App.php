<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 11.11.2018
 * Time: 22:08
 */


class App
{
    public function __construct()
    {
        (new Controller())->start();
    }
}

