<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 13.12.2018
 * Time: 20:21
 */

namespace app\Repository;


use app\Model\EnumEncoder;
use app\Model\Session;

class RepositorySessionSerializing implements RepositorySession
{
    const dir = 'sessions';
    public function loadSession(int $id): Session
    {
        $filename = START_DIR.DIRECTORY_SEPARATOR.self::dir.DIRECTORY_SEPARATOR.$id;
        $handle = fopen($filename, 'r');
        $contents = fread($handle, filesize($filename));
        $session = unserialize($contents);
        fclose($handle);
        return $session;
    }

    public function saveSession(Session $session):int
    {
        if($session->getId()==self::DEFAULT_ID)
        {
            $id = 1+file_get_contents(START_DIR.DIRECTORY_SEPARATOR.self::dir.DIRECTORY_SEPARATOR.'current.txt');
            file_put_contents(START_DIR.DIRECTORY_SEPARATOR.self::dir.DIRECTORY_SEPARATOR.'current.txt',$this->id);
            return $id;
        }
        else
        {
            $data = serialize($session);
            $filePath = START_DIR.DIRECTORY_SEPARATOR.self::dir.DIRECTORY_SEPARATOR.$session->getId();
            $fp = fopen($filePath, "w");
            fwrite($fp, $data);
            fclose($fp);
            return $session->getId();
        }
    }


}