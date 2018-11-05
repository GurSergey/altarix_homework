<?php

class Piston
{
	private $numberCylinder;
	//1 = открыт или 0 = закрыт
	private $state = 0;
	private $driver;
	
	function __construct(string $nameCylinder,int $state, bool $typeIsIn) {
       $this->name = 'Клапан '.($typeIsIn?'впуска ':'выпуска ').'из '.$nameCylinder;
	   $this->state = $state;
	   $this->driver = new Driver();
	}
	
	function DoWork()
	{
		switch($this->state)
		{
			case 0:
				$this->driver->DoAction($this->name, 'Открытие клапана');
				$this->state = 1;
				break;
			case 1:
				$this->driver->DoAction($this->name, 'Закрытие клапана');
				$this->state = 0;
				break;
		}
	}
	
	
}