<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 11.11.2018
 * Time: 22:38
 */
class ModelFacade
{
    public function newSession(EnumTypeSession $type)
    {
        $session = new Session($type);
        $session->saveOnFile();
        return $session->getId();
    }

    public function createPlayer1($name, $idSession)
    {
        $player = new Player();
        $session = Session::loadFromFile($idSession);
        $player->name = $name;
        $session->setPlayer1($player);
        $session->saveOnFile();

    }

    public function createPlayer2($name, $idSession)
    {
        $player = new Player();
        $session = Session::loadFromFile($idSession);
        $player->name = $name;
        $session->setPlayer2($player);
        $session->saveOnFile();

    }

    public function placeShips1($field, $id)
    {
        $session = Session::loadFromFile($id);
        $session->setField1($field);
        $session->saveOnFile();
    }

    public function placeShips2($field, $id)
    {
        $session = Session::loadFromFile($id);
        $session->setField2($field);
        $session->saveOnFile();
    }

    public function currentStateField1($id)
    {
        $session = Session::loadFromFile($id);

        return $session->getField1();
    }

    public function currentStateField2($id)
    {
        $session = Session::loadFromFile($id);
        //$session->saveOnFile();
        return $session->getField2();
    }

    public function shootPlayer1($x, $y, $idSession):bool
    {
        $session = Session::loadFromFile($idSession);
        $hit = $session->shootPlayer1($x, $y);
        $session->saveOnFile();
        return $hit;
    }

    public function shootPlayer2($x, $y, $idSession):bool
    {
        $session = Session::loadFromFile($idSession);
        $hit = $session->shootPlayer2($x, $y);
        $session->saveOnFile();
        return $hit;
    }

    public function isEnd($idSession)
    {
        $session = Session::loadFromFile($idSession);
        return $session->isEnd();
    }

    public function createNewGame($idSession)
    {
        $session = Session::loadFromFile($idSession);
        $session->newGame();
        $session->saveOnFile();
    }



}