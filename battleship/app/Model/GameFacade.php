<?php
/**
 * Класс посредник предоставляющий интерфейс между контроллером
 * и моделью
 */
namespace app\Model;

class GameFacade
{
    public function newSession(int $type)
    {
        GameLocator::setTypeGameCreate($type);
        $session = new Session();
        $session->saveOnFile();
        return $session->getId();
    }

    public function createPlayer(string $name, int $idSession, int $num)
    {
        $player = new Player();
        $session = Session::loadFromFile($idSession);
        $player->name = $name;
        $session->setPlayer($player, $num);
        $session->saveOnFile();
    }

    public function placeShips(Field $field, int $id, int $num)
    {
        $session = Session::loadFromFile($id);
        $session->getGame()->setField($field, $num);
        $session->saveOnFile();
    }


    public function currentStateField($id, $num)
    {
        $session = Session::loadFromFile($id);
        return $session->getGame()->getField($num);
    }


    public function shootPlayer($x, $y, $idSession, $num):bool
    {
        $session = Session::loadFromFile($idSession);
        $hit = $session->getGame()->shootField($x, $y, $num);
        $session->saveOnFile();
        return $hit;
    }


    public function isEnd($idSession)
    {
        $session = Session::loadFromFile($idSession);
        return $session->getGame()->isEnd();
    }

    public function createNewGame($idSession)
    {
        $session = Session::loadFromFile($idSession);
        $session->newGame();
        $session->saveOnFile();
    }



}