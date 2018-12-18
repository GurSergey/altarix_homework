<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 13:33
 */

namespace app\Repository;


class RepositorySessionSerializingFactory implements RepositorySessionFactory
{

    public function createRepositorySession(): RepositorySession
    {
        return new RepositorySessionSerializing();
    }
}