<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 19:08
 */

namespace app\Model;


class GameWithAI implements Game
{

    public function getField(int $num): Field
    {
        // TODO: Implement getField() method.
    }

    public function setField(Field $field, int $num)
    {
        // TODO: Implement setField() method.
    }

    public function shootField(int $x, int $y, int $num): bool
    {
        // TODO: Implement shootField() method.
    }

    public function isEnd(): bool
    {
        // TODO: Implement isEnd() method.
    }

    public function allowActionPlayer(int $num): bool
    {
        // TODO: Implement allowActionPlayer() method.
    }
}