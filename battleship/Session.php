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
    private $player1;
    private $player2;
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

    public function isEnd()
    {
        return $this->currentGame->isEnd();
    }

    public function getId()
    {
        $this->timeLastAction = time();
        return $this->id;
    }

    public function setPlayer1(Player $player)
    {
        $this->timeLastAction = time();
        $this->player1 = $player;
    }

    public function setPlayer2(Player $player)
    {
        $this->timeLastAction = time();
        $this->player2 = $player;
    }

    public function setField1(Field $field)
    {
        $this->timeLastAction = time();
        $this->currentGame->setField1($field);
    }

    public function setField2(Field $field)
    {
        $this->timeLastAction = time();
        $this->currentGame->setField2($field);
    }

    public function getField1():Field
    {
        $this->timeLastAction = time();
        return $this->currentGame->getField1();
    }

    public function getField2():Field
    {
        $this->timeLastAction = time();
        return $this->currentGame->getField2();
    }

    public function shootPlayer1(int $x, int $y):bool
    {
        $this->timeLastAction = time();
        return $this->currentGame->shootField2($x, $y);
    }

    public function shootPlayer2(int $x, int $y):bool
    {
        $this->timeLastAction = time();
        return $this->currentGame->shootField1($x, $y);
    }


    public static function loadFromFile($id):Session
    {

        $filename = './'.DIRECTORY_SEPARATOR."sessions".DIRECTORY_SEPARATOR.$id;
        $handle = fopen($filename, 'r');
        $contents = fread($handle, filesize($filename));
        $session = unserialize($contents);
        fclose($handle);
        return $session;
    }


}