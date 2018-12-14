<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 13.11.2018
 * Time: 12:37
 */

/**
 * @author GurSergey
 * Простой декодировщик данных от клиента
 * Используется максимально простое представление данных.
 * не лучший вариант. На первое время, потом переделать
 */
namespace app\DecoderData;

use app\Model\Field;

class DataDecoder implements Decoder
{
    const CELL_IS_BUSY = '1';
    const CELL_IS_NOT_BUSY = '0';

    public function decodeField(string $strBusy):Field
    {
        $field = new Field();
        $state = explode(' ', $strBusy);
        for($i = 0; $i < Field::SIZE_FIELD; $i++)
        {
            for($i1 = 0; $i1< Field::SIZE_FIELD; $i1++)
            {
                if($state[$i*Field::SIZE_FIELD+$i1]==self::CELL_IS_BUSY) {
                    $field->setBusyState($i, $i1);
                }
            }
        }
        return $field;
    }

}