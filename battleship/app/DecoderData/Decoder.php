<?php

/**
 * @author GurSergey
 * Интерфейс декодировщика информации от пользователя
 */
namespace app\DecoderData;

use app\Model\Field;

interface Decoder
{
    public function decodeField(string $strBusy):Field;
}