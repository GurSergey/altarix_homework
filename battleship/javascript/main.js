
$(document).ready(function() {

    let stateEnum = Object.freeze({"waitResponse":0,"newSession":1,"inputNamePlayer1":2, "inputNamePlayer2":3,
        "placementShips1":4,"placementShips2":5, "movePlayer1":6,
        "movePlayer2":7, "waitPlayer1":8, "waitPlayer2":9, "newGame":10});
    let isNewSession = false;
    let currentState = stateEnum.inputNamePlayer1;

    let bodyEnum = Object.freeze({
            "newSession": 0,
            "newPlayer1": function () {
                return 'command=newPlayer&idSession=' + currentSession +
                    '&name=' + $("namePlayer").val()+'&num=0';
            },
            "newPlayer2": function () {
                return 'command=newPlayer&idSession=' + currentSession +
                    '&name=' + $("namePlayer").val()+'&num=1';
            },
            "placementShips1": function () {
                return 'command=placementShips&idSession=' + currentSession +
                    '&placement=' + getStateField(0)+'&num=0';
            },
            "placementShips2": function () {
                return 'command=placementShips&idSession=' + currentSession +
                    '&placement=' + getStateField(1)+'&num=1';
            },
            "stateField1": function () {
                return 'command=currentStateField&idSession=' + currentSession+'&num=0';
            },
            "stateField2": function () {
                return 'command=currentStateField&idSession=' + currentSession+'&num=1';
            },
            "shootPlayer1": function (x, y) {
                return 'command=shootPlayer&idSession=' + currentSession + '&x=' + x + '&y=' + y+'&num=1';
            },
            "shootPlayer2": function (x, y)
            {
                return 'command=shootPlayer&idSession=' + currentSession + '&x=' + x + '&y=' + y+'&num=0';
            },
            "currentStateField1":function()
            {
                return 'command=currentStateField&idSession='+currentSession+'&num=0';
            },
            "currentStateField2":function()
            {
                return 'command=currentStateField&idSession='+currentSession+'&num=1';
            }});

    let currentSession =1;
    let stateBusy1 = '';
    let stateHit1 = '';
    let stateBusy2 = '';
    let stateHit2 = '';



    function response(body, callback)
    {
        $.post( "index.php",body ,callback).fail( function(xhr, textStatus, errorThrown) {
            alert(xhr.responseText);
        });;
    }

    function getStateField(num)
    {
        var strState = "";
        for (i = 0; i<$($(".playArea")[num]).find(".playSquare").length; i++) {
            if($($($(".playArea")[num]).find(".playSquare").get(i)).hasClass("isSelect"))
            {strState +='1 ';}
            else{ strState +='0 ';}
        }
        //console.log(strState);
        return strState;
    }

    function setStateField(data ,num, isYours)
    {
        let str = data;
        let arrStr = str.split('f');
        let stateBusy1 = arrStr[0];
        stateBusy1 = stateBusy1.split(' ');
        //console.log(stateBusy1);
        let stateHit1 = arrStr[1];
        stateHit1 = stateHit1.split(' ');
        stateHit1.splice(0,1);
        if(isYours) {
            $($(".playField").get(num)).removeClass("unActive").addClass("stateMy");
        }
        else {
            $($(".playField").get(num)).addClass("hit");
        }
        for(i = 0; i<stateBusy1.length-1; i++) {
            $($($(".playArea")[num]).find(".playSquare").get(i)).removeClass("isSelect");
            if ((stateHit1[i] == '1') && (stateBusy1[i] == '1')) {
                $($($(".playArea")[num]).find(".playSquare").get(i)).addClass("hitSquare");
            }
            else
            if ((stateBusy1[i] == '1') && (stateHit1[i] == '0') && (isYours)){
                $($($(".playArea")[num]).find(".playSquare").get(i)).addClass("notEmpty");}
            else
            if ((stateBusy1[i] == '0') && (stateHit1[i] == '1')) {
                $($($(".playArea")[num]).find(".playSquare").get(i)).addClass("hitEmpty");
            }
        }
    }


    $("#actionSend").click(function clickButton()
    {

        switch (currentState)
        {
            case stateEnum.inputNamePlayer1:
                response(bodyEnum.newPlayer1(), function(data)
                {
                    console.log(data);
                    $("#informationLabel").text("Введите имя игрок 2");
                    currentState = stateEnum.inputNamePlayer2;
                });
                break;
            case stateEnum.inputNamePlayer2:
                response(bodyEnum.newPlayer2(), function(data)
                {
                    console.log(data);
                    $("#informationLabel").text("Расставьте корабли игрок 1");
                    $($(".playField").get(0)).removeClass("unActive").addClass("placement");
                    currentState = stateEnum.placementShips1;
                });
                break;
            case stateEnum.placementShips1:
                response(bodyEnum.placementShips1(), function(data)
                {
                    console.log(data);
                    $($(".playField").get(0)).removeClass("placement").addClass("unActive");
                    $($(".playField").get(1)).addClass("placement");
                    $("#informationLabel").text("Расставьте корабли игрок 2");
                    currentState = stateEnum.placementShips2;
                });
                break;
            case stateEnum.placementShips2:
                response(bodyEnum.placementShips2(), function(data)
                {
                    console.log(data);
                    $("#informationLabel").text("Нажмите далее игрок 1");
                    $($(".playField").get(1)).removeClass("placement").addClass("unActive");
                    currentState = stateEnum.waitPlayer1;
                });
                break;
            case stateEnum.waitPlayer1:
                response(bodyEnum.stateField1(), function(data)
                {
                    console.log(data);
                    setStateField(data, 0, true);
                    $("#informationLabel").text("Делайте свой ход игрок 1");
                    $($(".playField").get(1)).removeClass("placement");
                    currentState = stateEnum.movePlayer1;
                    response(bodyEnum.stateField2(), function(data)
                    {
                        setStateField(data, 1, false);
                    });
                });

                break;
            case stateEnum.movePlayer1:
                 x = 0;
                 y = 0;

                $($(".playField").get(0)).removeClass("stateMy").addClass("unActive");
                $($(".playField").get(1)).removeClass("hit").addClass("unActive");

                for (var i = 0; i<$($(".playField").get(1)).find(".playSquare").length; i++) {
                    //console.  log(document.getElementsByClassName("playArea").item(1).getElementsByClassName("colorArea").item(i).classList);
                    console.log(i);
                    if($($($(".playField")[1]).find(".playSquare").get(i)).hasClass("isSelect"))
                    {
                        x = i %10;
                        y = Math.floor(i/10);
                    }
                }
                for(var i = 0; i<$(".playSquare").length; i++)
                {
                    $($(".playSquare").get(i)).removeClass("hitEmpty").removeClass("isSelect").
                    removeClass("hitSquare").removeClass("notEmpty");
                }

                //alert(x);
                //alert(y);
                response(bodyEnum.shootPlayer1(x, y), function(data)
                {
                    console.log(data);
                        str =data;
                        if(str == "w") {
                            $("#informationLabel").text("Игрок 1 выиграл конец игры");
                            currentState = stateEnum.newGame;
                        }
                        else
                        if(str =='1')
                        {
                            $("#informationLabel").text("Игрок 1 попал");
                            currentState = stateEnum.waitPlayer1;
                        }
                        else
                        if(str =='0')
                        {
                            $("#informationLabel").text("Игрок 1 не попал. Передайте управление игроку 2");
                            currentState = stateEnum.waitPlayer2;
                        }
                });
                break;

            case stateEnum.waitPlayer2:
                response(bodyEnum.stateField2(), function(data)
                {
                    console.log(data);
                    setStateField(data, 1, true);
                    $("#informationLabel").text("Делайте свой ход игрок 2");
                    $($(".playField").get(0)).removeClass("placement");
                    currentState = stateEnum.movePlayer2;

                    response(bodyEnum.stateField1(), function(data)
                    {
                        setStateField(data, 0, false);
                    });
                });


                break;

            case stateEnum.movePlayer2:
                  x = 0;
                  y = 0;

                $($(".playField").get(1)).removeClass("stateMy").addClass("unActive");
                $($(".playField").get(0)).removeClass("hit").addClass("unActive");
                console.log($($(".playField").get(0)).find(".playSquare").length);
                for (var i = 0; i<$($(".playField").get(0)).find(".playSquare").length; i++) {
                    //console.log(document.getElementsByClassName("playArea").item(1).getElementsByClassName("colorArea").item(i).classList);
                    //console.log(i);
                    if($($($(".playField").get(0)).find(".playSquare").get(i)).hasClass("isSelect"))
                    {
                        x = i %10;
                        y = Math.floor(i/10);
                    }
                }
                for(var i = 0; i<$(".playSquare").length; i++)
                {
                    $($(".playSquare").get(i)).removeClass("hitEmpty").removeClass("isSelect").
                    removeClass("hitSquare").removeClass("notEmpty");
                }

                //alert(x);
                //alert(y);
                response(bodyEnum.shootPlayer2(x, y), function(data)
                {
                    console.log(data);
                    str = data;
                    if(str == "w") {
                        $("#informationLabel").text("Игрок 2 выиграл конец игры");
                        currentState = stateEnum.newGame;
                    }
                    else
                    if(str =='1')
                    {
                        $("#informationLabel").text("Игрок 2 попал");
                        currentState = stateEnum.waitPlayer2;
                    }
                    else
                    if(str =='0')
                    {
                        $("#informationLabel").text("Игрок 2 не попал. Передайте управление игроку 2");
                        currentState = stateEnum.waitPlayer1;
                    }
                });
                break;


        }
    });


    $(".containerSquare").click(function clickSquare()
    {
        let square = $(this).children();
        if(!square.hasClass("isSelect"))
        {
            square.addClass("isSelect");
        }
        else
        {
            square.removeClass("isSelect");
        }
    });

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



});


