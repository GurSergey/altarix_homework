<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 13.11.2018
 * Time: 10:10
 */



class DataEncoder implements Encoder
{
    const CELL_IS_BUSY = '1 ';
    const CELL_IS_NOT_BUSY = '0 ';
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
                $state .= $field->getSquare($i, $i1)->getBusy()?self::CELL_IS_BUSY:self::CELL_IS_NOT_BUSY;
            }
        }
        $state .=self::DELIMITER;
        for($i = 0; $i <Field::SIZE_FIELD; $i++)
        {
            for ($i1 = 0; $i1 < Field::SIZE_FIELD; $i1++)
            {
                $state .= $field->getSquare($i, $i1)->getIsShot()?self::CELL_IS_SHOT:self::CELL_IS_NOT_SHOT;
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