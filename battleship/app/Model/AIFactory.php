<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 12:32
 */

namespace app\Model;


interface AIFactory
{
    public function createAI():AI;
}