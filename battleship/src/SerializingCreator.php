<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 01.12.2018
 * Time: 21:21
 */

class SerializingCreator implements CreatorSession
{
    public function createSession():Session{
        $session = new Session();

    }
}