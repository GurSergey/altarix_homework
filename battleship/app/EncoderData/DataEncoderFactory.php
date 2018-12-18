<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 17:31
 */

namespace app\EncoderData;


class DataEncoderFactory implements EncoderFactory
{

    public function createEncode(): Encoder
    {
        return new DataEncoder();
    }
}