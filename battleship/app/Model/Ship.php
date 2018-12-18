<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 01.12.2018
 * Time: 20:37
 */

namespace app\Model;

class Ship
{
    private $size;
    private $cells;

    public function getSize():int
    {
        return $this->size;
    }

    public function setSize(int $size)
    {
        $this->size = $size;
    }

    public function setCell(Cell $cell)
    {
        $this->cells[] = $cell;
    }

    public function isSunk():bool
    {
        $flag = true;
        foreach($this->cells as $cell) {
            if($cell->getIsShot()==false)
            {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    public function containCell(int $x, int $y)
    {
        $flag = false;
        //var_dump($this->cells );
        foreach($this->cells as $cell)
        {

            if(($cell->getX()==$x)&&($cell->getY()==$y))
            {
                $flag = true;
                break;
            }
        }
        return $flag;
    }

}