<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 11.11.2018
 * Time: 22:36
 */

namespace app\Model;

use app\ConstantsGame;
use app\GameExceptions\CountShipsError;
use app\GameExceptions\MaxSizeShipError;
use app\GameExceptions\PlacementCellError;

class GameOnOneComputer implements Game
{
    private $fields;


    const COUNT_OF_FOUR_DECK_SHIPS = 1;
    const COUNT_OF_THREE_DECK_SHIPS = 2;
    const COUNT_OF_TWO_DECK_SHIPS = 3;
    const COUNT_OF_ONE_DECK_SHIPS = 4;

    const MAX_SIZE_SHIP = 4;


    public function __construct()
    {
        for ($i = ConstantsGame::MIN_NUM; $i < ConstantsGame::MAX_NUM; $i++) {
            $this->fields[$i] = null;
        }
    }

    public function getField(int $num): Field
    {
        return $this->fields[$num];
    }


    public function setField(Field $field, int $num)
    {
        $this->fields[$num] = $field;
        $this->checkField($num);
    }

    private function checkField($num): bool
    {
        $addedCells = [];
        //var_dump($this->fields[$num]);
        $counterShips = [ $this::COUNT_OF_ONE_DECK_SHIPS,
            $this::COUNT_OF_TWO_DECK_SHIPS,
            $this::COUNT_OF_THREE_DECK_SHIPS,
            $this::COUNT_OF_FOUR_DECK_SHIPS];
        for($x = 0; $x < ConstantsGame::SIZE_FIELD; $x++)
        {
            for($y = 0; $y < ConstantsGame::SIZE_FIELD; $y++)
            {
                $currentCell = $this->fields[$num]->getCell($x, $y);
                if($currentCell->getBusy() && !in_array($currentCell, $addedCells) ) {

                    $isHorizontal = false;

                    $i = 0;
                    if ((($x + 1 < ConstantsGame::SIZE_FIELD)) && ($this->fields[$num]->getCell($x+1 , $y)->getBusy()))
                    {
                        while (($currentCell->getBusy()) && ($x + $i < ConstantsGame::SIZE_FIELD)) {
                            if ($i > 0) {
                                $isHorizontal = true;
                            }
                            $addedCells[] = $currentCell;
                            $currentShip[] = $currentCell;
                            $i++;

                            if ($x + $i < ConstantsGame::SIZE_FIELD) {
                                $currentCell = $this->fields[$num]->getCell($x + $i, $y);
                            }
                        }
                    }
                    elseif ((($y + 1 < ConstantsGame::SIZE_FIELD)) && ($this->fields[$num]->getCell($x , $y+1)->getBusy()))
                    {
                        while (($currentCell->getBusy()) && ($y + $i < ConstantsGame::SIZE_FIELD) && (!$isHorizontal)) {
                        $addedCells[] = $currentCell;
                        $currentShip[] = $currentCell;

                        $i++;

                            if($y + $i < ConstantsGame::SIZE_FIELD) {
                                $currentCell = $this->fields[$num]->getCell($x, $y + $i);
                            }
                        }
                    }
                    else
                    {
                        $addedCells[] = $currentCell;
                        $currentShip[] = $currentCell;
                    }


                    $size = sizeof($currentShip);
                    $ship = new Ship();
                    if ($size > self::MAX_SIZE_SHIP) {

                        $cellError = current($currentShip);
                        throw new MaxSizeShipError($cellError->getX(), $cellError->getY());
                    }
                    $ship->setSize($size);
                    foreach ($currentShip as $cell) {

                        $this->checkOneCellPlacement($cell, !$isHorizontal, $size == 1, $num);
                        $ship->setCell($cell);
                    }
                    $this->fields[$num]->addShip($ship);
                    $counterShips[$size - 1]--;

                    $currentShip = array();
                }
            }
        }


        foreach ($counterShips as $count)
        {
            if($count!=0)
            {
                //var_dump($counterShips);
                throw new CountShipsError();
            }
        }
        return true;
    }

    private function checkOneCellPlacement(Cell $cell, bool $isVerticalShip,bool $isOneDeck , int $num)
    {
        $cellX = $cell->getX();
        $cellY = $cell->getY();

        for($x = -1; $x <= 1; $x++)
        {
            for($y = -1; $y <= 1; $y++)
            {
                if(($x!=0) &&($y!=0)) {
                    if ((($cellX + $x) >= 0 && ($cellX + $x) < ConstantsGame::SIZE_FIELD) &&
                        (($cellY + $y) >= 0 && ($cellY + $y) < ConstantsGame::SIZE_FIELD)) {
                        if(((($isVerticalShip)&&($x!=0)) || ((!$isVerticalShip)&&($y!=0)))||$isOneDeck)
                        {
                            $cellChecked = $this->fields[$num]->getCell($cellX + $x, $cellY + $y);
                            if($cellChecked->getBusy()) {
                                //var_dump($cellX + $x, $cellY + $y);
                                throw new PlacementCellError($cellX, $cellY);
                            }
                        }
                    }
                }
            }
        }
    }

    public function shootField(int $x, int $y,int $num): bool
    {
        return $this->fields[$num]->shotOnSquare($x, $y);
    }

    private function shipsIsSunk(int $num):bool
    {
        $flag = true;
        for($x = 0; $x < ConstantsGame::SIZE_FIELD; $x++) {
            for ($y = 0; $y < ConstantsGame::SIZE_FIELD; $y++) {
                if ($this->fields[$num]->getCell($x, $y)->getBusy()
                    && !$this->fields[$num]->getCell($x, $y)->getIsShot()) {
                    $flag = false;
                    break(2);
                }
            }
        }
        return $flag;
    }

    public function isEnd():bool
    {
        for($i = ConstantsGame::MIN_NUM; $i <= ConstantsGame::MAX_NUM; $i++)
        {
            if($this->shipsIsSunk($i))
                return true;
        }
        return false;
    }

    public function allowActionPlayer(int $num): bool
    {
        return true;
    }
}