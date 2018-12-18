<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 13.11.2018
 * Time: 10:10
 */

/**
 * @author GurSergey
 * Простой кодировщик данных от клиента
 * Используется максимально простое представление данных.
 * не лучший вариант. На первое время, потом переделать
 */
namespace app\EncoderData;


use app\Model\Field;

class DataEncoder implements Encoder
{
    const CELL_IS_BUSY = '1 ';
    const CELL_IS_NOT_BUSY = '0 ';
    const CELL_SINK_SHIP = '2 ';
    const CELL_IS_SHOT = '1 ';
    const CELL_IS_NOT_SHOT = '0 ';
    const DELIMITER = 'f ';

    const OK = 'ok';

    const WIN_STR = 'w';
    const HIT ='1';
    const MISS ='0';
    const PLAYER_ONE = 0;
    const PLAYER_TWO = 1;

    public function encodeField(Field $field):string
    {

        $state = '';
        for($i = 0; $i <Field::SIZE_FIELD; $i++)
        {
            for ($i1 = 0; $i1 < Field::SIZE_FIELD; $i1++)
            {
                $state .= $field->getCell($i, $i1)->getBusy()?self::CELL_IS_BUSY
                    :self::CELL_IS_NOT_BUSY;
            }
        }
        $state .=self::DELIMITER;
        for($i = 0; $i <Field::SIZE_FIELD; $i++)
        {
            for ($i1 = 0; $i1 < Field::SIZE_FIELD; $i1++)
            {
                if($field->getCell($i, $i1)->getIsShot())
                {
                    if(($field->getCell($i, $i1)->getBusy())&&
                    ($field->getShipByCell($i, $i1)->isSunk())){
                            $state .=  self::CELL_SINK_SHIP;
                    }
                    else {
                        $state .= self::CELL_IS_SHOT;
                    }
                }
                else {
                    $state .= self::CELL_IS_NOT_SHOT;
                }
            }
        }
        return $state;
    }


    public function encodeOK():string
    {
       return self::OK;
    }

    public function encodeShoot(bool $hit, bool $isEnd, int $num): string
    {
        if($hit)
        {
            if($isEnd==true) {
                return self::WIN_STR;

            }
            else {
                return self::HIT;
            }
        }
        else
        {
            return self::MISS;
        }
    }
}