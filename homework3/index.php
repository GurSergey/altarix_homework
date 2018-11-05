<?php
	function ConvertNToDec(String $value,  int $baseN)//перевод из основания N в 10 СИ, когда в СИ заканчиваются цифры использовать буквы англйиского алвафита вплоть до z
	{
		$result = 0;
		$value=strtolower($value);
		for($i = strlen($value)-1; $i>=0; $i--)
		{
			
			if(ctype_digit($value[$i]))
			{
				if(intval($value[$i])<$baseN)
				{
					$result +=  $value[$i] * ($baseN**(strlen($value)-1-$i));
				}
				else
				{
					return 'Error!!!'; //ошибка если вышли за пределы оснавния системы
				}
			}
			elseif (ctype_alpha($value[$i]))
			{
				if((ord($value[$i])-ord('a')+10)<$baseN)
				{
					$result += (ord($value[$i])-ord('a')+10) * ($baseN**(strlen($value)-1-$i));
				}
				else{
					return 'Error!!!';//ошибка если вышли за пределы оснавния системы
				}
			}
			else
			{
				return 'Error!!!';//ошибка если вышли за пределы оснавния системы
			}
		
		}
		return $result;
	}
	
	function ConvertDecToN(int $value,  int $baseN) //перевод из 10 СИ в СИ с основанием N
	{
		$result = '';
		
		while($value!=0)
		{
			$buf = $value%$baseN;
			$value = floor($value/$baseN);
			if($buf>=10)
			{
				$result = chr(ord('A')+$buf-10) . $result;
			}
			else{
				$result = $buf . $result;
			}
		}

		return $result;
	}
	
	function ConvertNtoN(String $value,  int $baseN1, int $baseN2 ) // перевод из СИ с основанием N1 в основание N2
	{
		$valueDecN1 = ConvertNToDec($value, $baseN1);
		if($valueDecN1==='Error!!!')
			return 'Error!!!';
		return ConvertDecToN($valueDecN1, $baseN2);
	}
	
	echo '1023 в восмиричной СИ равно ' .ConvertNtoN(1023, 8, 16).' в системе с основанием 16';
	echo "<br>";
	echo '1021 в троичной СИ равно ' .ConvertNtoN(1021, 3, 16).' в системе с основанием 16';
	
	
	