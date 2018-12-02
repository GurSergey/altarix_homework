<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 11.11.2018
 * Time: 22:35
 */

class Session
{
    private $id;
    private $token;
    private $currentGame;

    private $timeCreated;
    private $timeLastAction;

    private $players;
    private $type;


    const dir = 'sessions';



    public function __construct(EnumTypeSession $type)
    {

        $this->timeCreated = time();
        $this->timeLastAction = time();
        $this->type = $type;
        $this->id = 1+file_get_contents('./'.DIRECTORY_SEPARATOR.self::dir.DIRECTORY_SEPARATOR.'current.txt');
        file_put_contents('./'.DIRECTORY_SEPARATOR.self::dir.DIRECTORY_SEPARATOR.'current.txt',$this->id);
        $this->currentGame = new Game($this->type);
    }

    public function newGame()
    {
        $this->currentGame = new Game($this->type);
    }

    public function saveOnFile()
    {
        $data = serialize( $this);

        $filePath = './'.DIRECTORY_SEPARATOR."sessions".DIRECTORY_SEPARATOR.$this->id;

            $fp = fopen($filePath, "w");
            fwrite($fp, $data);
            fclose($fp);

    }

    public function getGame():Game
    {
        return $this->currentGame;
    }

    public function getId():int
    {
        return $this->id;
    }

    public function setPlayer(Player $player, int $num)
    {
        if($num > ConstantsGame::MAX_NUM|| $num < ConstantsGame::MIN_NUM)
        {
            var_dump("error player");
            die();
        }
        $this->players[$num] = $player;
    }

    public static function loadFromFile($id):Session
    {

        $filename = './'.DIRECTORY_SEPARATOR.self::dir.DIRECTORY_SEPARATOR.$id;
        $handle = fopen($filename, 'r');
        $contents = fread($handle, filesize($filename));
        $session = unserialize($contents);
        fclose($handle);
        return $session;
    }


}