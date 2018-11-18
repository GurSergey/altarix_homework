<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 13.11.2018
 * Time: 10:10
 */



class DataEncoder// implements Encoder
{

    public static function encodeField(Field $field)
    {
        //var_dump(count($field->getField()));
        $state = '';
        foreach ($field->getField() as $line)
        {
            foreach ($line as $square)
            {
                $state .= $square->getBusy()?'1 ':'0 ';
            }
        }
        $state .='f ';
        foreach ($field->getField() as $line)
        {
            foreach ($line as $square)
            {
                $state .= $square->getIsShot()?'1 ':'0 ';
            }
        }
        return $state;
    }

    public static function encodeShotField(Field $field)
    {
        $state = '';

    }
}