<?php
/**
 * Контейнер позволяющий сыграть несколько игр подряд
 */

namespace app\Model;

use app\ConstantsGame;
use app\GameExceptions\NumPlayerError;
use app\Repository\RepositorySessionSerializing;

class Session
{
    private $id = -1;
    private $token;
    private $currentGame;

    private $timeCreated;
    private $timeLastAction;

    private $players;
    private $type;






    public function __construct(EnumTypeSession $type)
    {

        $this->timeCreated = time();
        $this->timeLastAction = time();
        $this->type = $type;
        $this->id = (new RepositorySessionSerializing())->saveSession($this);

        //file_put_contents(START_DIR.DIRECTORY_SEPARATOR.self::dir.DIRECTORY_SEPARATOR.'current.txt',$this->id);
        $this->currentGame = new Game($this->type);
    }

    public function newGame()
    {
        $this->currentGame = new Game($this->type);
    }

    public function saveOnFile()
    {
        (new RepositorySessionSerializing())->saveSession($this);
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
            throw new NumPlayerError();
        }
        $this->players[$num] = $player;
    }

    public static function loadFromFile($id):Session
    {
        return (new RepositorySessionSerializing())->loadSession($id);
    }


}