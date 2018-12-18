<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 13:38
 */

namespace app\GameExceptions;


class ConfigError extends GameException
{
    protected $name = "ConfigError";
    protected $message = "Ошибка конфигурации проекта";
    protected $code = 9;
}