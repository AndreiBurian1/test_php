<?php 
session_start();
class Validation{
    //////валидация имени
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
                $_SESSION['error_nik1']  = 'Имя должно быть не менее 4 символов';
            }

        } else {
            $_SESSION['error_nik1']  = 'Поле не заполнено!';
            unset($_SESSION['nik1']);
        }
    }
    public function pass ($string1, $string2){
        if(!empty($string1) && trim($string1) == $string1){
            $_SESSION['password3'] = $string1;
            unset($_SESSION['error_password3']);
        } else{
            $_SESSION['error_password3']  = 'Поле пароль не заполнено';
            unset($_SESSION['password3']);
        }
        if(!empty($string2) && trim($string2) == $string2){
            $_SESSION['password4'] = $string2;
            unset($_SESSION['error_password4']);
        } else{
            $_SESSION['error_password4']  = 'Поле пароль не заполнено';
            unset($_SESSION['password4']);
        }

        if ($_SESSION['password3'] == $_SESSION['password4']){
            $_SESSION['password5'];
        }
        else{
            $_SESSION['error_password5']  = 'Пароль 1 и 2 не совпадают!';
        }        
            }
}
class Registraciya{
    protected $soed;
    public function __construct($host, $user, $pass, $bd){
        $this->soed = mysqli_connect($host, $user, $pass, $bd) or die('ERROR: Cannot connect to the databdase!');
        $sql2 = "INSERT INTO ragistration SET user_name ='".$_SESSION['nik1']."', user_password ='".$_SESSION['password4']."'";
        $stpokabaza = mysqli_query($this->soed, $sql2);
         }
    }
$val = new Validation();
$val->name($_POST['nik1']);
$val->pass($_POST['password3'], $_POST['password4']);
////////////////////Общая проверка полей, чтобы записать в базу данных!!!!
if(!empty($_SESSION['nik1']) && ($_SESSION['password3'] == $_SESSION['password4'])){
    $bd = new Registraciya('localhost', 'root', '', 'project_2');
    $_SESSION['uspeh'] = 'Вы зарегистрированны как ' . $_SESSION['nik1'];
    $_SESSION['login'] = $nik1;
}

header('Location: /#buttonregistraciya'); //РИДИРЕКТ
exit;

 ?>