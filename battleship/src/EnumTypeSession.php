<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 11.11.2018
 * Time: 22:47
 */

class EnumTypeSession// extends SplEnum
{

    private $code;
    const onOneComputer = 0;
    const withAI = 1;
    const onTwoComputer = 2;

    public function __construct(int $code)
    {
        $this->code = $code;
    }
    public function getCode()
    {
        return $this->code;
    }
}