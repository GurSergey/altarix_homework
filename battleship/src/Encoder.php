<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 13.11.2018
 * Time: 13:35
 */

interface Encoder
{
    public function encodeOK():string;
    public function encodeField(Field $field):string;
    public function encodeShoot(bool $hit, bool $isEnd ,int $num ):string;
}