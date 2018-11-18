<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 11.11.2018
 * Time: 22:35
 */

class Field
{
    private $field;
    const sizeField = 10;


    public function __construct(array $field)
    {
        $this->field = $field;
    }

    public function shipsIsSunk()
    {
        $flag = true;
        if (is_array($this->field))
        foreach ($this->field as $line)
        {
            foreach ($line as $square)
            {
                if($square->getBusy() && !$square->getIsShot()) {
                    $flag = false;

                    break(2);
                }
            }
        }

        return $flag;
    }

    public function shotOnSquare(int $x, int $y): bool
    {
        $this->field[$y][$x]->shot();

        return $this->field[$y][$x]->getBusy();

    }

    public function getField()
    {
        //var_dump(count($this->field));
        return $this->field;
    }


//    public function placeShip(int $xStart, int $yStart, int $size, bool $isVertical)
//    {
//
//    }



}