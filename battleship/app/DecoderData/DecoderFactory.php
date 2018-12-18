<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 14:49
 */

namespace app\DecoderData;


interface DecoderFactory
{
    public function createDecoder():Decoder;
}