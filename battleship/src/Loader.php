<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 01.12.2018
 * Time: 19:43
 */

interface Loader
{
    public function loadSession($id):Session;
}