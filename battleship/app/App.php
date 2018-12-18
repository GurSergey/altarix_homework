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
namespace app;

//use app\Controller;

class App
{

    public function __construct()
    {
        FactoriesConfigurator::getRepositorySessionFactory();
        (new Controller())->start();
    }
}

