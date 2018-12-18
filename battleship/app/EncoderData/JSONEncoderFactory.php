<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 17:29
 */

namespace app\EncoderData;


class JSONEncoderFactory implements EncoderFactory
{

    public function createEncode(): Encoder
    {
        return new JSONEncoder();
    }
}