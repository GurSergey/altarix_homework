<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 14:51
 */

namespace app\DecoderData;


class DataDecoderFactory implements DecoderFactory
{
    public function createDecoder(): Decoder
    {
        return new DataDecoder();
    }
}