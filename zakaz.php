<?php 

class Zaproszakaz extends ConnectBD{//Метоты поключения в БД и все результаты запросов засовуется в один массив $data
	public $data;
	public function bdzapiszakaz(){
			if (!empty($_SESSION['loginbd'])) {
				$sql100 = "SELECT zakaz FROM ragistration WHERE user_name='".$_SESSION['loginbd']."'";
				$query100 = mysqli_query($this->soed_bd, $sql100);
				while ($res100 = mysqli_fetch_assoc($query100)) {
				$infazakaz = $res100;
				}
					$unseriainfazakaz1= unserialize($infazakaz['zakaz']);
					///////////////////Удаляем из массива NULL
					$unseriainfazakaz = array_filter($unseriainfazakaz1);
					$this->data = $unseriainfazakaz;
					//////////////////////////Второй запрос на всю инфу
			}

	}
	
	public function rashetsum($unseriainfazakaz){
		////////////////Оставляем только цыфры
		foreach ($unseriainfazakaz as $val) {
			foreach ($val as $key => $value) {
				$result[] = preg_replace("/[^,.0-9]/", '', $value);
			}
		}////////////// Минучуем ц символа
		foreach ($result as  $value) {
			 $resultsum[] = mb_substr( $value, 2); 
		}
		////////////////Производим расчет
			$sum[][] = 'Общая сумма купленных билетов состовляет - ' . array_sum($resultsum);
 		$datasum = array_merge($unseriainfazakaz, $sum);
 		$form[][] = '<form action="/system/formdelete.php" method="post"><button type="submit" class="btn btn-success" name="btn">Удалить заказ</button></form>';
 		$dataformsum = array_merge($datasum, $form);
		$this->data = $dataformsum;
	 
	}

}
	$zapros = new Zaproszakaz('localhost', 'root', '', 'project_2');
 	$zapros->bdzapiszakaz();
	$zapros->rashetsum($zapros->data);

$requ->getView('zakaz', $zapros->data);

?>

