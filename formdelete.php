<?php 
session_start();
class Deleta{
    ////////////////////////коструктор подключеник
    protected $soed;
    public function __construct($host, $user, $pass, $bd){
    $this->soed = mysqli_connect($host, $user, $pass, $bd) or die('ERROR: Cannot connect to the databdase!');
        }
      
     
    ///////////////////////////////////////Запрос в базу 
 	public function del($post){
 		if (!empty($post) == NULL) {
            $sql200 = "UPDATE ragistration SET zakaz='".NULL."' WHERE user_name='".$_SESSION['loginbd']."'";
            $query1000 = mysqli_query($this->soed, $sql200);
            $_SESSION['delete22'] = 'Заказ удален. Сделайте заказ снова';
            unset($_SESSION['uspeh_zakaz']);
        }
}
}

$val = new Deleta('localhost', 'root', '', 'project_2');
$val->del($_POST["btn"]);

header('Location: /');
exit;
 ?>

