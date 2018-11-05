<?php
	function MindFunction(int $temp, int $tempYesterday, int $tempTomorrow, bool $isPrecipation, string $phraseAnne){
		
		$phraseMother = '';
		$phraseMother.=TakeHat($temp, $tempYesterday, $tempTomorrow, 13, 11);
		$phraseMother.=CheckClothes($temp, $tempYesterday, $tempTomorrow, $phraseAnne, 'холодно','заморозки','замерзла');
		$phraseMother.=TakeUmbrellaScarf($temp, $tempTomorrow, $isPrecipation, 3);
		$phraseMother.=NotAllow($temp, $tempYesterday, $tempTomorrow, 5, $phraseAnne, 'холодно','заморозки','замерзла');
	
		return $phraseMother;
	}
	
	function TakeHat(int $temp, int $tempYesterday, int $tempTomorrow, $treshhold1, $treshhold2)
	{
		if(($temp<$treshhold1)&&($tempYesterday>=$treshhold2)&&($tempTomorrow>=$treshhold2))
		{
			return 'одень шапку ';
		}
		elseif(($temp<$treshhold1)&&($tempYesterday<$treshhold2)&&($tempTomorrow<$treshhold2))
		{
			return 'одень зимнюю шапку ';
		}
		return '';
	}
	
	function CheckClothes(int $temp, int $tempYesterday, int $tempTomorrow, string $phraseAnne ,...$words)
	{
		
		if(DecreasesTemperature($temp,  $tempYesterday,  $tempTomorrow)||IsInPhrase($phraseAnne, ...$words))
		{
			return 'ты хорошо оделся? ';
		}
		return '';
	}
	
	function TakeUmbrellaScarf(int $temp, int $tempTomorrow, bool $isPrecipation, $treshhold )
	{
		if($isPrecipation)
		{
			return 'и возьми с собой зонтик'.(DifferenceIsLarger($temp, $tempTomorrow, $treshhold)?' и шарф':'');
		}
		return '';
	}
	
	function NotAllow(int $temp, int $tempYesterday, int $tempTomorrow, $treshhold, $phraseAnne, ...$words)
	{
		if(DecreasesTemperature($temp,  $tempYesterday,  $tempTomorrow) && (DifferenceIsLarger($temp, $tempTomorrow, $treshhold)) &&
		IsInPhrase($phraseAnne, $words))
		{
			return 'не пройдешь';
		}
		return '';	
	}
	
	
	function DecreasesTemperature(int $temp, int $tempYesterday, int $tempTomorrow)
	{
		return ($tempYesterday>$temp)&&($temp>$tempTomorrow);
	}
	
	function DifferenceIsLarger($temp1, $temp2, $treshhold)
	{
		return (($temp1-$temp1)>$treshhold);
	}
	
	function IsInPhrase(string $phrase, ...$words)
	{
		foreach ($words as $word) {
			
			if(strpos($phrase,$word)!==false)
			{
				return true;
			}
			
		}
		return false;
	}
	
	
	
	foreach (array('temp', 'tempYesterday', 'tempTomorrow', 'isPrecipation', 'phrase') as $code)
	{  
		if (!isset($_GET[$code]))
		{
			echo "Ошибка! Нет нужных параметров!";
			die();
		}
	}
	
	
	$temp = $_GET['temp'];
	$tempYesterday = $_GET['tempYesterday'];
	$tempTomorrow = $_GET['tempTomorrow'];
	$isPrecipation = $_GET['isPrecipation'];
	$phrase = $_GET['phrase'];
	
	function HaveError($code)
	{
		echo "Ошибка с типами параметров. Код причины $code";
		die();
	}
	
	
	if(!ctype_digit($temp)||!ctype_digit($tempYesterday)||!ctype_digit($tempTomorrow))
	{
		haveError(1);
	}
	
	if($isPrecipation!='true'&&$isPrecipation!='false')
	{
		haveError(2);
	}
	
	$isPrecipation = $isPrecipation=='true'?true:false;
	
	echo MindFunction($temp, $tempYesterday, $tempTomorrow, $isPrecipation, $phrase );