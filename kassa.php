<?php 
class Zaprosi extends ConnectBD{//Метоты поключения в БД и все результаты запросов засовуется в один массив $data
	public $data;
	public $data1;
	public function bdzapis(){///////Запрос на номера билетов для чекбокса
		for ($i=1; $i < 5 ; $i++) {
			// $kol2[] = mysqli_fetch_assoc(mysqli_query($this->soed_bd, "SELECT namber_ticet FROM ticet WHERE id_karegori='".$i."'"));
			$sql33 = "SELECT cena_ticet, namber_ticet AS namber".$i." FROM ticet WHERE id_karegori='".$i."'";
			$query33 = mysqli_query($this->soed_bd, $sql33);
			while ($res33[] = mysqli_fetch_assoc($query33)) {
			$namber = $res33;
			}
		}
		$this->data = $namber;

		///////Запрос подсчета билетов по категории
		for ($i=1; $i < 5 ; $i++) {//считаем в каждой категории количество билетов всего
			$kol1[] = mysqli_fetch_assoc(mysqli_query($this->soed_bd, "SELECT COUNT(*) AS kol".$i." FROM ticet WHERE id_karegori='".$i."'"));
		}
		$this->data1 = $kol1;
	}

}
	$zapros = new Zaprosi('localhost', 'root', '', 'project_2');
 	$zapros->bdzapis();
/////////////////////////////////Сливаем в один массив
$datatogethe = array_merge($zapros->data, $zapros->data1);
// var_dump($datatogethe);

// Далее Делаем с ОБЩЕГО массива Выбираем только то что нам нужно
//  // var_dump($zapros->data);
// $infa = array();
// foreach ($zapros->data as $m) {
// $infa[] = array(
// 	// 'id_ticet' => $m['id_ticet'],
// 	'1' => $m['kol1'],
// 	'2' => $m['kol2'],
// 	'3' => $m['kol3'],
// 	// 'short_description' => $m['short_description'],
// 	// 'link' => '/index.php?route=news&news_id='.$m['news_id'],
// 	);
//   }


$requ->getView('kassa', $datatogethe);


  ?>
