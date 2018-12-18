<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 12.11.2018
 * Time: 15:28
 */
namespace app\Model;
use app\GameExceptions\PlacementError;
use app\GameExceptions\ReHitError;

class Cell
{
    private $squareIsBusy = false;
    private $squareIsShot = false;
    private $x;
    private $y;
    /**
     * @return int
     */
    public function getX():int
    {
        return $this->x;
    }

    /**
     * @param int $x
     */
    public function setX(int $x)
    {
        $this->x = $x;
    }

    /**
     * @return int
     */
    public function getY():int
    {
        return $this->y;
    }

    /**
     * @param int $y
     */
    public function setY(int $y)
    {
        $this->y = $y;
    }


    public function __construct(bool $squareIsBusy)
    {
        $this->squareIsBusy = $squareIsBusy;
    }

    public function shot()
    {
        if($this->squareIsShot)
        {
            throw new ReHitError();
        }
        else
        {
            return $this->squareIsShot = true;
        }
    }

    public function getIsShot()
    {
        return $this->squareIsShot;
    }

    public function setBusy(bool $squareIsBusy)
    {
        $this->squareIsBusy = $squareIsBusy;
    }

    public function getBusy()
    {
        return $this->squareIsBusy;
    }

}