<?php


/**
 * @author GurSergey
 * Контроллер производит получение HTTP запросов, и
 * кидает в модель новые данные на основе этих запросов
 */
namespace app;







use app\DecoderData\DataDecoder;
use app\DecoderData\JSONDecoder;
use app\EncoderData\DataEncoder;
use app\EncoderData\JSONEncoder;
use app\GameExceptions\GameException;
use app\GameExceptions\NoCommandError;
use app\GameExceptions\NoPageError;
use app\Model\EnumEncoder;
use app\Model\EnumTypeGame;
use app\Model\GameFacade;
use app\View\MakerOnOnePage;
use app\View\MakerStartPage;

class Controller{

    const typeDecodeEncoder = 0;
    private $encoder;
    private $decoder;


    const ERROR_TEXT = 'ErrorFields! ';
    const COMMAND_NAME_PARAM = 'command';
    const ID_NAME_PARAM = 'idSession';
    const NAME_PLAYER_NAME_PARAM = 'name';
    const NUM_NAME_PARAM = 'num';
    const PLACEMENT_NAME_PARAM = 'placement';
    const X_NAME_PARAM = 'x';
    const Y_NAME_PARAM = 'y';
    const TYPE_NAME_PARAM = 'type';

    const GET_PAGE_COMMAND = 'getPage';
    const ON_ONE_PAGE = "onOneComputer";
    const TYPE_PAGE_PARAM = "type";



    const NEW_SESSION_COMMAND = 'newSession';
    const NEW_PLAYER_COMMAND = 'newPlayer';
    const PLACEMENT_SHIPS_COMMAND = 'placementShips';
    const STATE_FIELD_COMMAND = 'currentStateField';
    const SHOOT_PLAYER_COMMAND = 'shootPlayer';
    const NEW_GAME_COMMAND = 'newGame';




    private function checkField(... $fields)
    {
        foreach ($fields as $field)
        {
            if (!isset($_POST[$field]))
            {
                echo self::ERROR_TEXT.$field;
                die();
            }
        }
    }

    public function __construct()
    {
        $this->decoder = FactoriesConfigurator::getDataDecoderFactory()->createDecoder();
        $this->encoder = FactoriesConfigurator::getDataEncoderFactory()->createEncode();
    }

    public function start()
    {
        try {
            if (empty($_POST) && empty($_GET)) {
                echo (new MakerStartPage())->getPage();
                die();
            }

            if(!empty($_GET[self::COMMAND_NAME_PARAM])) {
                $command = $_GET[self::COMMAND_NAME_PARAM];
            }
            if (isset($command)) {
                switch ($command) {
                    case self::GET_PAGE_COMMAND:
                        $page = $_GET[self::TYPE_PAGE_PARAM];
                        switch ($page) {
                            case self::ON_ONE_PAGE:
                                echo (new MakerOnOnePage())->getPage();
                                die();
                                break;
                            default:
                                throw new NoPageError();
                                break;
                        }
                        break;
                }
            }

            $this->checkField(self::COMMAND_NAME_PARAM);
            $command = $_POST[self::COMMAND_NAME_PARAM];

            $model = new GameFacade();
            switch ($command) {
                case self::NEW_SESSION_COMMAND:
                    $this->checkField(self::TYPE_NAME_PARAM);
                    $type = $_POST[self::TYPE_NAME_PARAM];
                    echo $model->newSession($type);
                    break;
                case self::NEW_PLAYER_COMMAND:
                    $this->checkField(self::ID_NAME_PARAM, self::NAME_PLAYER_NAME_PARAM,
                        self::NUM_NAME_PARAM);
                    $id = $_POST[self::ID_NAME_PARAM];
                    $name = $_POST[self::NAME_PLAYER_NAME_PARAM];
                    $num = $_POST[self::NUM_NAME_PARAM];
                    $model->createPlayer($name, $id, $num);
                    echo $this->encoder->encodeOK();
                    break;
                case self::PLACEMENT_SHIPS_COMMAND:
                    $this->checkField(self::ID_NAME_PARAM, self::PLACEMENT_NAME_PARAM,
                        self::NUM_NAME_PARAM);
                    $id = $_POST[self::ID_NAME_PARAM];
                    $placement = $_POST[self::PLACEMENT_NAME_PARAM];
                    $num = $_POST[self::NUM_NAME_PARAM];
                    $model->placeShips($this->decoder->decodeField($placement), $id, $num);
                    echo $this->encoder->encodeOK();
                    break;
                case self::STATE_FIELD_COMMAND:
                    $this->checkField(self::ID_NAME_PARAM, self::NUM_NAME_PARAM);
                    $id = $_POST[self::ID_NAME_PARAM];
                    $num = $_POST[self::NUM_NAME_PARAM];
                    echo $this->encoder->encodeField($model->currentStateField($id, $num));
                    break;
                case self::SHOOT_PLAYER_COMMAND:
                    $this->checkField(self::ID_NAME_PARAM, self::X_NAME_PARAM,
                        self::Y_NAME_PARAM, self::NUM_NAME_PARAM);
                    $id = $_POST[self::ID_NAME_PARAM];
                    $x = $_POST[self::X_NAME_PARAM];
                    $y = $_POST[self::Y_NAME_PARAM];
                    $num = $_POST[self::NUM_NAME_PARAM];
                    $hit = $model->shootPlayer($x, $y, $id, $num);
                    echo $this->encoder->encodeShoot($hit, $model->isEnd($id), $num);
                    break;
                case self::NEW_GAME_COMMAND:
                    $this->checkField(self::ID_NAME_PARAM);
                    $id = $_POST[self::ID_NAME_PARAM];
                    $model->createNewGame($id);
                    echo $this->encoder->encodeOK();
                    break;
                default:
                    throw new NoCommandError();
                    break;
            }
        }
        catch (GameException $e)
        {
            echo "Error!<br>";
            echo $e->getName();
            echo $e->getMessage();
        }
    }
}