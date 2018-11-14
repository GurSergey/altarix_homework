let stateEnum = Object.freeze({"newSession":0,"inputNamePlayer1":1, "inputNamePlayer2":2,
    "placementShips1":3,"placementShips2":4, "movePlayer1":5,
    "movePlayer2":6, "waitPlayer1":7, "waitPlayer2":8, "newGame":9});
let isNewSession = false;
let currentState = stateEnum.inputNamePlayer1;
let commandEnum = Object.freeze
let currentSession =1;
let stateBusy1 = '';
let stateHit1 = '';
let stateBusy2 = '';
let stateHit2 = '';

function response(body, callback)
{

    //var body = body;
    //console.log(123);
    xhr = new XMLHttpRequest();
    xhr.open("POST", '../../BattleShipBackend/index.php', true);
    //xhr.
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = callback;

    xhr.send(body);

}

function countdown() {
    function clickButton()
    {

        switch (currentState)
        {
            case stateEnum.inputNamePlayer1:
                //console.log(123);
                response('command=' + 'newPlayer1&idSession='+currentSession+'&name1='+document.getElementById('namePlayer').value, function()
                {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        //alert(xhr.responseText);
                        document.getElementById("informationLabel").innerText = "Введите имя игрок 2";
                        currentState = stateEnum.inputNamePlayer2;
                    }
                });

                //xhr.send();


                break;
            case stateEnum.inputNamePlayer2:
                response('command=' + 'newPlayer2&idSession='+currentSession+'&name2='+document.getElementById('namePlayer').value, function()
                {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        //alert(xhr.responseText);
                        document.getElementById("informationLabel").innerText = "Расставте корабли игрок 1";
                        document.getElementsByClassName("playField").item(0).classList.remove("unActive");
                        document.getElementsByClassName("playField").item(0).classList.add("placement");
                        currentState = stateEnum.placementShips1;
                    }
                });
                break;
            case stateEnum.placementShips1:
                var strState = "";
                console.log(document.getElementsByClassName("playArea").item(0).getElementsByClassName("colorArea"));
                for (i = 0; i<document.getElementsByClassName("playArea").item(0).getElementsByClassName("colorArea").length; i++) {
                    console.log(document.getElementsByClassName("playArea").item(0).getElementsByClassName("colorArea").item(i).classList);
                    if(document.getElementsByClassName("playArea").item(0).getElementsByClassName("colorArea").item(i).classList.contains("isSelect"))
                    {
                        strState +='1 ';
                    }
                    else
                    {
                        strState +='0 ';
                    }
                }

                response('command=' + 'placementShips1&idSession='+currentSession+'&placement='+strState, function()
                {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        //alert(xhr.responseText);
                        document.getElementsByClassName("playField").item(0).classList.add("unActive");
                        document.getElementsByClassName("playField").item(0).classList.remove("placement");
                        document.getElementsByClassName("playField").item(1).classList.add("placement");
                        document.getElementById("informationLabel").innerText = "Расставте корабли игрок 2";
                        currentState = stateEnum.placementShips2;
                    }
                });
                break;
            case stateEnum.placementShips2:
                strState = "";
                for (i = 0; i<document.getElementsByClassName("playArea").item(1).getElementsByClassName("colorArea").length; i++) {
                    console.log(document.getElementsByClassName("playArea").item(1).getElementsByClassName("colorArea").item(i).classList);
                    if(document.getElementsByClassName("playArea").item(1).getElementsByClassName("colorArea").item(i).classList.contains("isSelect"))
                    {
                        strState +='1 ';
                    }
                    else
                    {
                        strState +='0 ';
                    }
                }

                response('command=' + 'placementShips2&idSession='+currentSession+'&placement='+strState, function()
                {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        //alert(xhr.responseText);
                        document.getElementById("informationLabel").innerText = "Нажмите далее игрок 1";
                        document.getElementsByClassName("playField").item(1).classList.remove("placement");
                        currentState = stateEnum.waitPlayer1;
                    }
                });
                break;
                case stateEnum.waitPlayer1:
                    response('command=' + 'currentStateField1&idSession='+currentSession, function()
                    {
                        if (xhr.readyState == XMLHttpRequest.DONE) {
                            let str = xhr.responseText;
                            let arrStr = str.split('f');
                            //alert(str);
                            stateBusy1 = arrStr[0];

                            stateBusy1 = stateBusy1.split(' ');
                            console.log(stateBusy1);
                            stateHit1 = arrStr[1];
                            stateHit1 = stateHit1.split(' ');
                            stateHit1.splice(0,1);
                            document.getElementsByClassName("playField").item(0).classList.remove("unActive");
                            document.getElementsByClassName("playField").item(0).classList.add("stateMy");
                            //alert(stateBusy1.length);
                            for(i = 0; i<stateBusy1.length-1; i++) {
                                document.getElementsByClassName("playArea").item(0).getElementsByClassName("colorArea").item(i).classList.remove("isSelect");
                                if ((stateHit1[i] == '1') && (stateBusy1[i] == '1')) {
                                    document.getElementsByClassName("playArea").item(0).getElementsByClassName("colorArea").item(i).classList.add("hitSquare");
                                }
                                else {
                                    if ((stateBusy1[i] == '1')&& (stateHit1[i] == '0'))
                                        document.getElementsByClassName("playArea").item(0).getElementsByClassName("colorArea").item(i).classList.add("notEmpty");
                                    else
                                    if ((stateBusy1[i] == '0')&& (stateHit1[i] == '1'))
                                        document.getElementsByClassName("playArea").item(0).getElementsByClassName("colorArea").item(i).classList.add("hitEmpty");
                                }
                            }

                            document.getElementById("informationLabel").innerText = "Делайте свой ход игрок 1";
                            document.getElementsByClassName("playField").item(1).classList.remove("placement");
                            currentState = stateEnum.movePlayer1;

                            response('command=' + 'currentStateField2&idSession='+currentSession, function()
                            {
                                if (xhr.readyState == XMLHttpRequest.DONE) {
                                    let str = xhr.responseText;
                                    let arrStr = str.split('f');
                                    //alert(str);
                                    stateBusy2 = arrStr[0];
                                    stateBusy2 = stateBusy2.split(' ');
                                    stateHit2 = arrStr[1];
                                    stateHit2 = stateHit2.split(' ');
                                    stateHit2.splice(0,1);
                                    document.getElementsByClassName("playField").item(1).classList.add("hit");
                                    for(i = 0; i<stateBusy2.length-1; i++)
                                    {
                                        document.getElementsByClassName("playArea").item(1).getElementsByClassName("colorArea").item(i).classList.remove("isSelect");
                                        if ((stateHit2[i] == '1') && (stateBusy2[i] == '1')) {
                                            document.getElementsByClassName("playArea").item(1).getElementsByClassName("colorArea").item(i).classList.add("hitSquare");
                                        }
                                        else {
                                            if ((stateBusy2[i] == '0') && (stateHit2[i] == '1'))
                                                document.getElementsByClassName("playArea").item(1).getElementsByClassName("colorArea").item(i).classList.add("hitEmpty");
                                        }
                                    }
                                    currentState = stateEnum.movePlayer1;
                                }
                            });

                        }
                    });

                    break;
                case stateEnum.movePlayer1:
                    x = 0;
                    y = 0;

                    document.getElementsByClassName("playField").item(0).classList.remove("stateMy");
                    document.getElementsByClassName("playField").item(0).classList.add("unActive");
                    document.getElementsByClassName("playField").item(1).classList.remove("hit");
                    document.getElementsByClassName("playField").item(1).classList.add("unActive");


                    for (i = 0; i<document.getElementsByClassName("playField").item(1).getElementsByClassName("colorArea").length; i++) {
                        console.log(document.getElementsByClassName("playArea").item(1).getElementsByClassName("colorArea").item(i).classList);
                        console.log(i);
                        if(document.getElementsByClassName("playField").item(1).getElementsByClassName("colorArea").item(i).classList.contains("isSelect"))
                        {
                            //alert("!!!");
                            x = i %10;
                            y = Math.floor(i/10);
                        }
                    }
                    for(i = 0; i<document.getElementsByClassName("colorArea").length; i++)
                    {
                        document.getElementsByClassName("colorArea").item(i).classList.remove("hitEmpty");
                        document.getElementsByClassName("colorArea").item(i).classList.remove("isSelect");
                        document.getElementsByClassName("colorArea").item(i).classList.remove("hitSquare");
                        document.getElementsByClassName("colorArea").item(i).classList.remove("notEmpty");
                    }

                    //alert(x);
                    //alert(y);
                    response('command=' + 'shootPlayer1&idSession='+currentSession+'&x='+x+'&y='+y, function()
                    {
                        if (xhr.readyState == XMLHttpRequest.DONE) {
                            str =xhr.responseText;

                            if(str == "win p1") {
                                document.getElementById("informationLabel").innerText = "Игрок 1 выиграл конец игры";
                                currentState = stateEnum.newGame;
                            }
                            else
                            if(str =='1')
                            {
                                document.getElementById("informationLabel").innerText = "Игрок 1 попал. Передайте управление игроку 2";
                                currentState = stateEnum.waitPlayer2;
                            }
                            else
                            if(str =='0')
                            {
                                document.getElementById("informationLabel").innerText = "Игрок 1 не попал. Передайте управление игроку 2";
                                currentState = stateEnum.waitPlayer2;
                            }


                            //currentState = stateEnum.waitPlayer2;
                        }
                    });
                    break;

            case stateEnum.waitPlayer2:
                response('command=' + 'currentStateField2&idSession='+currentSession, function()
                {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        let str = xhr.responseText;
                        let arrStr = str.split('f');
                        //alert(str);
                        stateBusy2 = arrStr[0];

                        stateBusy2 = stateBusy2.split(' ');
                        //console.log(stateBusy2);
                        stateHit2 = arrStr[1];
                        stateHit2 = stateHit2.split(' ');
                        stateHit2.splice(0,1);
                        document.getElementsByClassName("playField").item(1).classList.remove("unActive");
                        document.getElementsByClassName("playField").item(1).classList.add("stateMy");
                        console.log("Отладка");
                        console.log(stateBusy2);
                        for(i = 0; i<stateBusy2.length-1; i++) {
                            document.getElementsByClassName("playArea").item(1).getElementsByClassName("colorArea").item(i).classList.remove("isSelect");
                            if ((stateHit2[i] == '1') && (stateBusy2[i] == '1')) {
                                document.getElementsByClassName("playArea").item(1).getElementsByClassName("colorArea").item(i).classList.add("hitSquare");
                            }
                            else {
                                if ((stateBusy2[i] == '1')&& (stateHit2[i] == '0'))
                                    document.getElementsByClassName("playArea").item(1).getElementsByClassName("colorArea").item(i).classList.add("notEmpty");
                                else
                                if ((stateBusy2[i] == '0')&& (stateHit2[i] == '1'))
                                    document.getElementsByClassName("playArea").item(1).getElementsByClassName("colorArea").item(i).classList.add("hitEmpty");
                            }
                        }

                        document.getElementById("informationLabel").innerText = "Делайте свой ход игрок 2";
                        document.getElementsByClassName("playField").item(0).classList.remove("placement");
                        currentState = stateEnum.movePlayer1;

                        response('command=' + 'currentStateField1&idSession='+currentSession, function()
                        {
                            if (xhr.readyState == XMLHttpRequest.DONE) {
                                let str = xhr.responseText;
                                let arrStr = str.split('f');
                                //alert(str);
                                stateBusy1 = arrStr[0];
                                stateBusy1 = stateBusy1.split(' ');
                                stateHit1 = arrStr[1];
                                stateHit1 = stateHit1.split(' ');
                                stateHit1.splice(0,1);
                                document.getElementsByClassName("playField").item(0).classList.add("hit");
                                for(i = 0; i<stateBusy2.length-1; i++)
                                {
                                    document.getElementsByClassName("playArea").item(0).getElementsByClassName("colorArea").item(i).classList.remove("isSelect");
                                    if ((stateHit1[i] == '1') && (stateBusy1[i] == '1')) {
                                        document.getElementsByClassName("playArea").item(0).getElementsByClassName("colorArea").item(i).classList.add("hitSquare");
                                    }
                                    else {
                                        if ((stateBusy1[i] == '0') && (stateHit1[i] == '1'))
                                            document.getElementsByClassName("playArea").item(0).getElementsByClassName("colorArea").item(i).classList.add("hitEmpty");
                                    }
                                }
                                currentState = stateEnum.movePlayer2;
                            }
                        });

                    }
                });

                break;

            case stateEnum.movePlayer2:
                x = 0;
                y = 0;
                document.getElementsByClassName("playField").item(1).classList.remove("stateMy");
                document.getElementsByClassName("playField").item(1).classList.add("unActive");
                document.getElementsByClassName("playField").item(0).classList.remove("hit");
                document.getElementsByClassName("playField").item(0).classList.add("unActive");


                for (i = 0; i<document.getElementsByClassName("playField").item(0).getElementsByClassName("colorArea").length; i++) {
                    console.log(document.getElementsByClassName("playField").item(0).getElementsByClassName("colorArea").item(i).classList);
                    if(document.getElementsByClassName("playField").item(0).getElementsByClassName("colorArea").item(i).classList.contains("isSelect"))
                    {

                        x = i %10;
                        y = Math.floor(i/10);
                    }
                }

                for(i = 0; i<document.getElementsByClassName("colorArea").length; i++)
                {
                    document.getElementsByClassName("colorArea").item(i).classList.remove("hitEmpty");
                    document.getElementsByClassName("colorArea").item(i).classList.remove("isSelect");
                    document.getElementsByClassName("colorArea").item(i).classList.remove("hitSquare");
                    document.getElementsByClassName("colorArea").item(i).classList.remove("notEmpty");
                }

                response('command=' + 'shootPlayer2&idSession='+currentSession+'&x='+x+'&y='+y, function()
                {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        str =xhr.responseText;
                        if(str == "win p2") {
                            document.getElementById("informationLabel").innerText = "Игрок 1 выиграл конец игры";
                            currentState = stateEnum.newGame;
                        }
                        else
                        if(str =='1')
                        {
                            document.getElementById("informationLabel").innerText = "Игрок 1 попал. Передайте управление игроку 2";
                            currentState = stateEnum.waitPlayer1;
                        }
                        else
                        if(str =='0')
                        {
                            document.getElementById("informationLabel").innerText = "Игрок 1 не попал. Передайте управление игроку 2";
                            currentState = stateEnum.waitPlayer1;
                        }


                        //currentState = stateEnum.waitPlayer2;
                    }
                });
                break;


        }
    }

    document.getElementById('actionSend').addEventListener("click",clickButton);


    function clickSquare(e)
    {
        //console.log(e.target.classList);
        if(!e.srcElement.classList.contains("isSelect")) {
            e.srcElement.classList.add("isSelect");
        }
        else {
            e.srcElement.classList.remove("isSelect");
        }
    }


    for (let i = 0; i< document.getElementsByClassName("containerSquare").length; i++) {
        //console.log(document.getElementsByClassName("playSquare").item(i));
        document.getElementsByClassName("containerSquare").item(i).addEventListener("click", clickSquare, true);
    }


    if(isNewSession)
    {
        response('command=' + 'newSession&type='+'0', function()
        {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                //alert(xhr.responseText);
                currentSession = xhr.responseText;
                isNewSession = false;
                currentState = stateEnum.inputNamePlayer1;
            }
        });
    }


}
