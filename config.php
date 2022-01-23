<?php 

class ConnectBD{//Соединение к Базе Данных с конструктором
	public $soed_bd;
	public function __construct($host, $user, $pass, $bd){
		$this->soed_bd = mysqli_connect($host, $user, $pass, $bd) or die('ERROR: Cannot connect to the databdase!');
	}
	 
}
 
$ee = new ConnectBD('localhost', 'root', '', 'project_2');//Конструктор отрабатывает при создания обьекта класса в котором находится

 ?>