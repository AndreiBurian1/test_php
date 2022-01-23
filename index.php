<?php 
session_start();
if (!empty($_GET['route'])) {
	$filename = $_SERVER['DOCUMENT_ROOT'] . "/controllers/". $_GET['route'] . ".php";
}

require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/system/request.php";

if($_SERVER['REQUEST_URI'] == '/'){
	require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/kassa.php";
}elseif (!empty($filename) && file_exists($filename)) {
	require_once $filename;
}else{
	require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/404.php";
}

 ?>
