<?php 
class Request{
	public function getView($name, $data = ''){
		return require_once $_SERVER['DOCUMENT_ROOT'] . "/views/".$name.".php";
	}
	public function getHeader($data = ''){
		return require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/header.php";
	}
	public function getFooter($data = ''){
		return require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/footer.php";
	}

}
	$requ = new Request();

 ?>

