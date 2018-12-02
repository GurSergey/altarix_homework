<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 11.11.2018
 * Time: 22:36
 */



class Game
{
    private $fields;
    //private $state;


    public function __construct($type)
    {
        for($i = ConstantsGame::MIN_NUM; $i < ConstantsGame::MAX_NUM; $i++) {
            $this->fields[$i] = null;
        }
    }

    public function getField(int $num):Field
    {
        return $this->fields[$num];
    }


    public function setField(Field $field,int $num)
    {
        $this->fields[$num] = $field;
    }

    public function shootField(int $x, int $y, $num):bool
    {
        return $this->fields[$num]->shotOnSquare($x, $y);
    }
    public function isEnd()
    {
        for($i = ConstantsGame::MIN_NUM; $i <= ConstantsGame::MAX_NUM; $i++)
        {
            if($this->fields[$i]->shipsIsSunk())
                return true;
        }
        return false;
    }
}