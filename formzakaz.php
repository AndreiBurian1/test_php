<?php 
session_start();
class Validation{

    public $serializemass;
    ////////////////////////коструктор подключеник
    protected $soed;
    public function __construct($host, $user, $pass, $bd){
    $this->soed = mysqli_connect($host, $user, $pass, $bd) or die('ERROR: Cannot connect to the databdase!');
        }
     /////////////////////валидация имени.
    public function name ($string){
        if(!empty($string) && trim($string)){
            $_SESSION['nik1'] = $string;
            unset($_SESSION['error_nik1']);

        function check_length($value = "", $min, $max) {
            $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
            return !$result;
        }
        if(check_length($string, 4, 15)) {
                $_SESSION['nik1'];
            } else {
                $_SESSION['error_nik1']  = 'Не менее 4 символов и не более 15';
            }

        } else {
            $_SESSION['error_nik1']  = 'Поле не заполнено!';
            unset($_SESSION['nik1']);
        }
    }
    //////валидация чекбоксов на ограничение выбора количество.
    public function ogranichenie ($int1, $int2, $int3, $int4){
    	if (count($int1) <= 2) {
    			$_SESSION['chek1'] = 'ок';
    			unset($_SESSION['error_chek1']);
    		}else{
    			$_SESSION['error_chek1'] = 'Не более 2-х билетов';
    		}
    	if (count($int2) <= 1) {
    			$_SESSION['chek2'] = 'ок';
    			unset($_SESSION['error_chek2']);
    		}else{
    			$_SESSION['error_chek2'] = 'Не более 1-го билета';
    		}	
    	if (count($int3) <= 1) {
    			$_SESSION['chek3'] = 'ок';
    			unset($_SESSION['error_chek3']);
    		}else{
    			$_SESSION['error_chek3'] = 'Не более 1-го билета';
    		}	

    	if (count($int4) <= 2) {
    			$_SESSION['chek4'] = 'ок';
    			unset($_SESSION['error_chek4']);
    		}else{
    			$_SESSION['error_chek4'] = 'Не более 2-х билетов';
    		}	
    }
    ///////////////////////////////////////Запрос в базу 
 	public function zakas(){
 		if (!empty($_SESSION['error_chek2']) || empty($_POST['q1']) && empty($_POST['q4']) && empty($_POST['q2']) && empty($_POST['q3']) || !empty($_SESSION['error_nik1']) || !empty($_SESSION['error_chek3']) || !empty($_SESSION['error_chek4']) || !empty($_SESSION['error_chek1'])) {

 			$_SESSION['error_zakaz'] = 'Ошибка!Сделайте выбор!';
            unset($_SESSION['uspeh_zakaz']);
 		}else{

                $masschek = array();
                $masschek['q1'] =  $_POST['q1'];                  
                $masschek['q2'] =  $_POST['q2'];                  
                $masschek['q3'] =  $_POST['q3'];  
                $masschek['q4'] =  $_POST['q4'];
                // $masschek[] =  $_POST['namezakaz'];
////////////////////Функция используем serialize 
                $serializemass1 = serialize($masschek);
                $this->serializemass = $serializemass1;
                // return $serializemass1;
                $sql55 = "UPDATE ragistration SET zakaz='".$serializemass1."' WHERE user_name='".$_SESSION['loginbd']."'";
                $result = mysqli_query($this->soed, $sql55); //ответ базы запишем в переменную $result. 


                $_SESSION['uspeh_zakaz'] = 'Вы успешно сделали свой заказ!
                Посмотреть свой заказ вы можете нажав <a href="http://project2/?route=zakaz">ВАШИ ЗАКАЗЫ</a>.';
                unset($_SESSION['error_zakaz']);
 		}
 	}
}


$val = new Validation('localhost', 'root', '', 'project_2');
$val->name($_POST['namezakaz']);
$val->ogranichenie($_POST['q1'], $_POST['q2'], $_POST['q3'], $_POST['q4']);
$val->zakas();




header('Location: /');
exit;
 ?>

