<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 02.12.2018
 * Time: 14:58
 */
/**
 * @author GurSergey
 * Загрузчик сессии из базы данных
 */
namespace app\Repository;
use app\Model\EnumEncoder;
use app\Model\Session;

class RepositorySessionDB implements RepositorySession
{

    public function loadSession(int $id): Session
    {
        // TODO: Implement loadSession() method.
    }

    public function saveSession(Session $session)
    {
        // TODO: Implement saveSession() method.
    }


}