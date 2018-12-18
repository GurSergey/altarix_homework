<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 18:34
 */

namespace app\Model;


interface Game
{
    public function getField(int $num): Field;
    public function setField(Field $field, int $num);
    public function shootField(int $x, int $y,int $num): bool;
    public function isEnd():bool;

    public function allowActionPlayer(int $num): bool;
}