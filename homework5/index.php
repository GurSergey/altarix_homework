<?php
	function WorkWithText(string $text)
	{	
		$text = trim ($text, ' ');
		$arraySentences = explode( '.',$text);
		$i = 1;
		foreach($arraySentences as $sentence)
		{
			if(empty($sentence))
			{
				continue;
			}
			WorkWithSentence($i,$sentence);
			$i++;
		}
	}
	function WorkWithSentence(int $num, string $sentence){
		//var_dump($sentence);
		$sentence = trim ($sentence, ' ');
		$arrayWords = explode( ' ', $sentence);
		
		$arrayCounter = array();
		foreach($arrayWords as $word)
		{
			if(empty($word))
			{
				continue;
			}
			$word = trim($word, "  ,-");
			$length = iconv_strlen($word);
			if(!array_key_exists($length,$arrayCounter))
			{	
				$arrayCounter[$length] = 0;
			}
			$arrayCounter[$length]++;
			
		}
		
		
		OutputSentence($sentence, $num, $arrayCounter);
		
	}
	function OutputSentence(string $sentence,int $num, array $arrayCounter)
	{
		
		$sentence = $num .') '. $sentence;
		$sentence .= '. (';
		foreach($arrayCounter as $key=>$count)
		{
			$sentence .= $key.'-'.$count.' ';
		}
		$sentence .= ' )';
		echo $sentence.'<br>';
	}
	
	WorkWithText("Изначально зебры были распространены по всей Африке. В Северной Африке были истреблены уже в древности.");
	
	