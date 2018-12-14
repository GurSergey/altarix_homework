<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 13.11.2018
 * Time: 13:35
 */

/**
 * @author GurSergey
 * Интерфейс кодировщика информации от пользователя
 */
namespace app\EncoderData;

use app\Model\Field;

interface Encoder
{
    public function encodeOK():string;
    public function encodeField(Field $field):string;
    public function encodeShoot(bool $hit, bool $isEnd ,int $num ):string;
}