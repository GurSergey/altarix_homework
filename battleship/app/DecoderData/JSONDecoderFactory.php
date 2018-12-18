<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 14:52
 */

namespace app\DecoderData;


class JSONDecoderFactory implements DecoderFactory
{

    public function createDecoder(): Decoder
    {
        return new JSONDecoder();
    }
}