<?php
	
	foreach (array('name', 'surname', 'postCode', 'age', 'gender') as $code)
	{  
		if (!isset($_POST[$code]))
		{
			echo "Ошибка! Нет нужных параметров!";
			die();
		}
	}
	
	
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$age = $_POST['age'];
	$isPregnant = !isset($_POST['isPregnant'])? false : ($_POST['isPregnant']=="on"? true: "error");
	$isStudent = !isset($_POST['isStudent'])? false : ($_POST['isStudent']=="on"? true: "error");
	$postCode = $_POST['postCode'];
	$gender = $_POST['gender'];
	
	function haveError($code)
	{
		echo "Ошибка с типами параметров. Код причины $code";
		die();
	}
	
	if(($name == "")||($surname==""))
	{
		haveError(1);
	}
	if(!ctype_digit($age))
	{
		haveError(2);
	}
	if($isPregnant==="error"||$isStudent==="error")
	{
		haveError(3);
	}
	if(($gender!="м")&&($gender!="ж"))
	{
		haveError(4);
	}
	if(!ctype_digit($postCode))
	{
		haveError(5);
	}
	
	
	echo "Имя человека: ".$name.". <br>".
	"Начинается с буквы: ".$name[0].". <br>".
	"Последняя буква фамилии ".$surname[strlen($surname)-1].". <br>".
	(($age>25)?"Старше 25 лет ":"Младше 25 лет ").". <br>".
	((($gender=="м") && ($isPregnant))?" Пол не соответствует статусу!!! <br>":"").
	((($gender=="м") and ($isStudent))?" Человек является студентом. <br>":"").
	((($gender=="ж") and ($isStudent))?" Человек является студенткой. <br>": "").
	"Сумма почтового индекса с возрастом ". strval(intval($postCode)+$age).". "."<br>".
	((($surname[0]==$name[0]) xor ($surname[strlen($surname)-1]==$name[strlen($name)-1])) ? 
	" имя начинается с одной буквой с фамилией либо заканчивается на одну букву. ":". ")."<br>".
	" Квадрат возраста: ".strval($age**2).". <br>".
	" Через год исполнится ". strval(++$age)." . <br>".
	" Побитовое умножение возраста на 2  =". (--$age<<1).". ";