<?php



class Engine{
	
	//рядный двигатель с разницей хода 180 градусов
	//визуализация работы
	//https://www.youtube.com/watch?v=fvVxei4obcA
	
	private $cylinder1;
	private $cylinder2;
	private $cylinder3;
	private $cylinder4;
	private  $driver;
	private  $name = 'Двигатель';
	
	
	function __construct()
	{
		$this->driver = new Driver();
		$this->cylinder1 = new Cylinder('Цилиндр 1', 0);
		$this->cylinder2 = new Cylinder('Цилиндр 2', 1);
		$this->cylinder3 = new Cylinder('Цилиндр 3', 2);
		$this->cylinder4 = new Cylinder('Цилиндр 4', 3);
	}
	
	//функция которая заставляет делать внутренние устройства работу,
	//ничего не зная об их внутреннем состоянии
	function DoWork()
	{
		$this->driver->DoAction($this->name, 'начало такта');
		$this->cylinder1->DoWork();
		$this->cylinder2->DoWork();
		$this->cylinder3->DoWork();
		$this->cylinder4->DoWork();
		$this->driver->DoAction($this->name, 'конец такта');
	}
	
	function Start()
	{
		$this->driver->DoAction($this->name, 'Начало работы');
		for($i=0; $i<10; $i++)
		{
			$this->DoWork();
		}
		$this->driver->DoAction($this->name, 'Конец работы');
	}
	
}