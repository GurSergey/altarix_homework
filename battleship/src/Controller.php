<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 11.11.2018
 * Time: 22:34
 */



class Controller{

    const typeDecodeEncoder = 0;
    private $encoder;
    private $decoder;

    private function checkField(... $fields)
    {
        foreach ($fields as $field)
        {
            if (!isset($_POST[$field]))
            {
                echo "ErrorFields! ".$field;
                die();
            }
        }
    }

    public function __construct()
    {
        $this->checkField('command');
        $command = $_POST['command'];
        $model = new ModelFacade();


        switch (self::typeDecodeEncoder)
        {
            case 0:
                $this->decoder = new DataDecoder();
                $this->encoder = new DataEncoder();
                break;
            case 1:
                $this->decoder = new JSONDecoder();
                $this->encoder = new JSONEncoder();
                break;
        }

        switch ($command)
        {
            case 'newSession':
                $this->checkField('type');
                $type = new EnumTypeSession($_POST['type']);
                echo $model->newSession($type);
                break;
            case 'newPlayer1':
                $this->checkField('idSession', 'name1');
                $id = $_POST['idSession'];
                $name = $_POST['name1'];
                $model->createPlayer1($name, $id);
                echo 'ok';
                break;
            case 'newPlayer2':
                $this->checkField('idSession', 'name2');
                $id = $_POST['idSession'];
                $name = $_POST['name2'];
                $model->createPlayer2($name, $id);
                echo 'ok';
                break;
            case 'placementShips1':
                $this->checkField('idSession', 'placement');
                $id = $_POST['idSession'];
                $placement = $_POST['placement'];
                $model->placeShips1($this->decoder->decodeField($placement), $id);
                echo 'ok';
                break;
            case 'placementShips2':
                $this->checkField('idSession', 'placement');
                $id = $_POST['idSession'];
                $placement = $_POST['placement'];
                $model->placeShips2($this->decoder->decodeField($placement), $id);
                echo 'ok';
                break;
            case 'currentStateField1':
                $this->checkField('idSession');
                $id = $_POST['idSession'];
                echo $this->encoder->encodeField($model->currentStateField1($id));
                break;
            case 'currentStateField2':
                $this->checkField('idSession');
                $id = $_POST['idSession'];
                echo $this->encoder->encodeField($model->currentStateField2($id));
                break;
            case 'shootPlayer1':
                $this->checkField('idSession', 'x', 'y');
                $id = $_POST['idSession'];
                $x = $_POST['x'];
                $y = $_POST['y'];
                $hit = $model->shootPlayer1($x, $y, $id);
                if($hit)
                {
                    if($model->isEnd($id)==true) {
                        echo 'win p1';
                    }
                    else {
                        echo '1';
                    }
                }
                else
                {
                    echo '0';
                }
                break;
            case 'shootPlayer2':
                $this->checkField('idSession', 'x', 'y');
                $id = $_POST['idSession'];
                $x = $_POST['x'];
                $y = $_POST['y'];
                $hit = $model->shootPlayer2($x, $y, $id);
                if($hit)
                {
                    if($model->isEnd($id)==true){
                        echo 'win p2';
                    }
                    else{
                        echo '1';
                    }
                }
                else
                {
                    echo '0';
                }
                break;
            case 'NewGame':
                $this->checkField('idSession');
                $id = $_POST['idSession'];
                $model->createNewGame($id);
                echo 'ok';
                break;
            default:
                echo 'errorCommand';
                break;
        }
    }
}