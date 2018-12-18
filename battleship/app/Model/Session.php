<?php
/**
 * Контейнер позволяющий сыграть несколько игр подряд
 */

namespace app\Model;

use app\ConstantsGame;
use app\FactoriesConfigurator;
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
   // private $type;


    public function __construct()
    {

        $this->timeCreated = time();
        $this->timeLastAction = time();
        //$this->type = $type;
        $repository = FactoriesConfigurator::getRepositorySessionFactory()->createRepositorySession();
        //$this->id = (new RepositorySessionSerializing())->saveSession($this);
        $this->id = $repository->saveSession($this);

        //file_put_contents(START_DIR.DIRECTORY_SEPARATOR.self::dir.DIRECTORY_SEPARATOR.'current.txt',$this->id);

        //$this->currentGame = new GameOnOneComputer($this->type);
        $this->currentGame = GameLocator::getGame();
    }

    public function newGame()
    {
        //$this->currentGame = new GameOnOneComputer($this->type);
        $this->currentGame = GameLocator::getGame();
    }

    public function saveOnFile()
    {
        $repository = FactoriesConfigurator::getRepositorySessionFactory()->createRepositorySession();
        $repository->saveSession($this);
        //(new RepositorySessionSerializing())->saveSession($this);
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
        $repository = FactoriesConfigurator::getRepositorySessionFactory()->createRepositorySession();
        return $repository->loadSession($id);
        //return (new RepositorySessionSerializing())->loadSession($id);
    }


}