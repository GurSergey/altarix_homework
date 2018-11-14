<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 11.11.2018
 * Time: 22:36
 */
class Game
{
    private $field1;
    private $field2;



    public function __construct($type)
    {
        $this->field1 = null;
        $this->field2 = null;
        $this->type = $type;
    }

    public function getField1()
    {
        return $this->field1;
    }

    public function getField2()
    {
        return $this->field2;
    }

    public function setField1(Field $field)
    {
        $this->field1 = $field;
    }

    public function setField2(Field $field)
    {
        $this->field2 = $field;
    }
    public function shootField1(int $x, int $y):bool
    {
        return $this->field1->shotOnSquare($x, $y);
    }
    public function shootField2(int $x, int $y):bool
    {
        return $this->field2->shotOnSquare($x, $y);
    }

    public function isEnd()
    {
        return $this->field1->shipsIsSunk()||$this->field2->shipsIsSunk();
    }
}