<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 01.12.2018
 * Time: 19:43
 */

namespace app\Repository;

use app\Model\EnumTypeSession;
use app\Model\Session;

interface RepositorySession
{
    const DEFAULT_ID = -1;

    public function loadSession(int $id):Session;
    public function saveSession(Session $session):int;
}