<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 11.11.2018
 * Time: 22:08
 */

/**
 * @author GurSergey
 * Класс приложения. по сути точка входа
 */
class App
{
    public function __construct()
    {
        (new Controller())->start();
    }
}

