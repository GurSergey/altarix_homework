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
namespace app\Model;


use app\ConstantsGame;

class Field
{
    private $field;
    private $ships;

    const SIZE_FIELD = ConstantsGame::SIZE_FIELD;


    public function __construct()
    {
        for($i = 0; $i < self::SIZE_FIELD; $i++)
        {
            $this->field[$i] = array();
            for($i1 = 0; $i1< self::SIZE_FIELD; $i1++)
            {
                $cell = new Cell(false);
                $this->field[$i][$i1] = $cell;
                $cell->setX($i);
                $cell->setY($i1);
            }
        }
    }

    private function searchCell(int $x, int $y):Cell
    {
        foreach ($this->field as $line)
        {
            foreach ($line as $cell)
            {
                if($cell->getX()==$x && $cell->getY()==$y)
                    return $cell;
            }
        }
    }

    public function shotOnSquare(int $x, int $y): bool
    {
        $cell = $this->searchCell($x, $y);
        $cell->shot();
        return $cell->getBusy();
    }

    public function setBusyState($x, $y)
    {
        $this->searchCell($x, $y)->setBusy(true);
    }

    public function getCell($x, $y):Cell
    {
        return $this->searchCell($x, $y);
    }

    public function setCell($x, $y, Cell $cell)
    {
        $this->field[$x][$y] = $cell;
    }

    public function addShip(Ship $ship)
    {
        $this->ships[] = $ship;
    }

    public function getShipByCell($x, $y):Ship
    {
        foreach ($this->ships as $ship)
        {
           // var_dump($ship->getSize());
            if( $ship->containCell($x, $y))
                return $ship;
        }
    }

    public function returnShips():array
    {
        return $this->ships;
    }


}