<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 12.11.2018
 * Time: 15:53
 */
class EnumErrorOfModel //extends SplEnum
{
    const __default =  self::noError;

    const noError = 0;
    const placementError = 1;
    const reHitError = 2;

}