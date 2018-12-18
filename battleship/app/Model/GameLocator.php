<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 18:38
 */

namespace app\Model;


use app\GameExceptions\SessionTypeError;
use ReflectionClass;

class GameLocator
{
    const NAMESPACE = 'app\Model\\';
    private static $typeGameCreate = 0;

    public static function setTypeGameCreate(int $type)
    {
        self::$typeGameCreate = $type;
    }

    public static function getGame():Game
    {

        $className = EnumTypeGame::enum[self::$typeGameCreate];
        if($className == null)
        {
            throw new SessionTypeError();
        }

        try {
            return (new ReflectionClass(self::NAMESPACE . $className))->newInstance();
        } catch (\ReflectionException $e) {
            throw new SessionTypeError();
        }
    }


}