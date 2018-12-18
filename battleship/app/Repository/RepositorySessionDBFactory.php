<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 12:41
 */

namespace app\Repository;


class RepositorySessionDBFactory implements RepositorySessionFactory
{
    public function createRepositorySession(): RepositorySession
    {
        return new RepositorySessionDB();
    }
}