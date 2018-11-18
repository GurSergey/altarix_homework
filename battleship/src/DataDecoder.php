<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 13.11.2018
 * Time: 12:37
 */


class DataDecoder// implements Decoder
{
    public function decodeField(string $strBusy)
    {
        $field = array();
        $state = explode(' ', $strBusy);
        for($i = 0; $i < Field::sizeField; $i++)
        {
            $field[] = array();
            for($i1 = 0; $i1< Field::sizeField; $i1++)
            {
                $field[$i][$i1] = new SquareField($state[$i*Field::sizeField+$i1]=='1'?true:false);
            }
        }
        return new Field($field);
    }

}