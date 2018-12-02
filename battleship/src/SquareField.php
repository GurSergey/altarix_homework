<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 12.11.2018
 * Time: 15:28
 */

class SquareField
{
    private $squareIsBusy = false;
    private $squareIsShot = false;
   // private $

    public function __construct(bool $squareIsBusy)
    {
        $this->squareIsBusy = $squareIsBusy;
    }

    public function shot()
    {
        if($this->squareIsShot)
        {
            return EnumErrorOfModel::reHitError;
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