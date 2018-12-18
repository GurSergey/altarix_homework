<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 12:50
 */

namespace app;


use app\DecoderData\DataDecoderFactory;
use app\EncoderData\DataEncoderFactory;
use app\GameExceptions\ConfigError;

use app\Model\AIFactory;
use app\DecoderData\EnumDecoder;
use app\EncoderData\EnumEncoder;
use app\Repository\EnumRepositorySessionFactory;
use app\Repository\RepositorySessionFactory;
use ReflectionClass;

class FactoriesConfigurator
{
    const NAMESPACE_REPOSITORY_SESSION = "app\\Repository\\";
    const NAMESPACE_AI = "app\\Model\\";
    const NAMESPACE_DECODER_DATA = "app\\DecoderData\\";
    const NAMESPACE_ENCODER_DATA = "app\\EncoderData\\";

    const CONFIG_NAME = "Config.php";

    const STORAGE_CONFIG_NAME = "storage_config";
    const AI_CONFIG_NAME = "ai_config";
    const ENCODER_CONFIG_NAME ="encoder_config";
    const DECODER_CONFIG_NAME ="decoder_config";


    private static function getFactory(string $nameConfig,string $namespace, array $enum):ReflectionClass
    {
        $config = include (self::CONFIG_NAME);
        $code = $config[$nameConfig];
        $className = $enum[$code];
        if($className == null )
        {
            throw new ConfigError();
        }

        try {
            return new ReflectionClass($namespace . $className);
        } catch (\ReflectionException $e) {
            throw new ConfigError();
        }

    }

    static function getRepositorySessionFactory():RepositorySessionFactory
    {
        return self::getFactory(self::STORAGE_CONFIG_NAME,
            self::NAMESPACE_REPOSITORY_SESSION,
            EnumRepositorySessionFactory::enum)->newInstanceArgs();
    }

    static function getAIFactory():AIFactory
    {
//        return self::getFactory(self::AI_CONFIG_NAME,
//            self::NAMESPACE_AI)->newInstanceArgs();
    }

    static function getDataDecoderFactory():DataDecoderFactory
    {
        return self::getFactory(self::DECODER_CONFIG_NAME,
            self::NAMESPACE_DECODER_DATA,
            EnumDecoder::enum)->newInstanceArgs();
    }

    static function getDataEncoderFactory():DataEncoderFactory
    {
        return self::getFactory(self::ENCODER_CONFIG_NAME,
            self::NAMESPACE_ENCODER_DATA,
            EnumEncoder::enum)->newInstanceArgs();
    }
}