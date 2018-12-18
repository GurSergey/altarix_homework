<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 14:56
 */

namespace app\EncoderData;


interface EncoderFactory
{
    public function createEncode():Encoder;
}