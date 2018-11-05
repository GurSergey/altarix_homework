<?php

class Lamp
{
	
	private $name;
	private $driver;
	
	function __construct($nameCylinder) {
       $this->name = 'Лампочка из '. $nameCylinder;
	   $this->driver = new Driver();
	}
	function DoWork()
	{
		$this->driver->DoAction($this->name, 'Вспышка');
	}
}