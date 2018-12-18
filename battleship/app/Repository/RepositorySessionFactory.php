<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 12:37
 */

namespace app\Repository;


interface RepositorySessionFactory
{
    public function createRepositorySession():RepositorySession;
}