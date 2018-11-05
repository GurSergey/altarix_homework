<?php

class Cylinder{
	// одно из четырех состояний цилиндра
	// 0 - поршень исходно находится вверху и движется вниз, впускной клапан  открыт до перехода к 1
	// 1 - поршень исходно находится внизу и движется вверх,  клапаны закрыты, в момент перед переходом к 
	// 		2 происходит моргание лампочки имитирующей взрыв
	// 2 - поршень исходно находится вверху и движется вниз, клапаны закрыты, в момент перехода к 3 выпускной клапан открывается
	// 3 - поршень исходно находится внизу  и движется  вверх, выпускной клапан открыт, а впускной закрыт, до момента перехода к 0
	// при переходе клапаны меняют состояние
	private $state = 0;
	
	private $name = '';
	private $lamp;
	private $pistonIn;
	private $pistonOut;
	private $driver;
	
	
	function __construct($name, $state)
	{
		$this->name = $name;
		$this->state = $state;
		$this->lamp = new Lamp($this->name);
		$this->pistonIn = new Piston($this->name, $state==0?1:0, true);
		$this->pistonOut = new Piston($this->name, $state==3?1:0, false);
		$this->driver = new Driver();
	}
	
	function DoWork()
	{
		switch($this->state)
		{
			case 0:
				$this->driver->DoAction($this->name, 'Движение поршня вниз из верхней точки');
				$this->state = 1;
				$this->pistonIn->DoWork();
				break;
			case 1:
				$this->driver->DoAction($this->name, 'Движение поршня вверх из нижней точки');
				$this->state = 2;
				$this->lamp->DoWork();
				break;
			case 2:
				$this->driver->DoAction($this->name, 'Движение поршня вниз из верхней точки');
				$this->state = 3;
				$this->pistonOut->DoWork();
				break;
			case 3:
				$this->driver->DoAction($this->name, 'Движение поршня вверх из нижней точки');
				$this->state = 0;
				$this->pistonOut->DoWork();
				$this->pistonIn->DoWork();
				break;
		}
	}
	
	
}