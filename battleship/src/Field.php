<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 11.11.2018
 * Time: 22:35
 * Интерфейс Iterator необходим для возможности получения
 * списка ячеек не привязываясь к внутреннему способу хранения
 * этих ячеек
 */

class Field
{
    private $field;
    //private $currentSquare;

    const SIZE_FIELD = 10;
    const COUNT_OF_FIVE_DECK_SHIPS = 1;
    const COUNT_OF_FOUR_DECK_SHIPS = 2;
    const COUNT_OF_THREE_DECK_SHIPS = 3;
    const COUNT_OF_TWO_DECK_SHIPS = 4;
    const COUNT_OF_ONE_DECK_SHIPS = 5;

    public function __construct()
    {
        for($i = 0; $i < self::SIZE_FIELD; $i++)
        {
            $this->field[$i] = array();
            for($i1 = 0; $i1< self::SIZE_FIELD; $i1++)
            {
                $this->field[$i][$i1] = new SquareField(false);
            }
        }
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

    public function checkField():bool
    {

    }

    public function setBusyState($x, $y)
    {
        $this->field[$x][$y]->setBusy(true);
    }

    public function getSquare($x, $y):SquareField
    {
        return $this->field[$x][$y];
    }

}