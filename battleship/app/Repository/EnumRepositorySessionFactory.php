<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.12.2018
 * Time: 12:58
 */

namespace app\Repository;


class EnumRepositorySessionFactory
{
    const enum = [0=>"RepositorySessionSerializingFactory",
        1=>"RepositorySessionDBFactory",
        2=>"RepositorySessionJSONFactory"];
}