<?php

/**
 * @author GurSergey
 * Интерфейс декодировщика информации от пользователя
 */
interface Decoder
{
    public function decodeField(string $strBusy):Field;
}