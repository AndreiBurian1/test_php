<?php 
session_start();
///////////////////////////////Авторизация
    class Avtorizaciya{
        public $rezalt;
        protected $soed;
        public function __construct($host, $user, $pass, $bd){
        $this->soed = mysqli_connect($host, $user, $pass, $bd) or die('ERROR: Cannot connect to the databdase!');
        }
         public function zapros($login, $password){
            $query = 'SELECT*FROM ragistration WHERE user_name="'.$login.'" AND user_password="'.$password.'"';
            $result = mysqli_query($this->soed, $query); //ответ базы запишем в переменную $result. 
            $user = mysqli_fetch_assoc($result); //преобразуем ответ из БД в нормальный массив PHP
            $this->rezalt = $user;
        }   
    }
    //Если форма авторизации отправлена...
    if ( !empty($_POST['login']) && trim($_POST['login']) && trim($_POST['password']) && !empty($_POST['password']) ) {

        $bd = new Avtorizaciya('localhost', 'root', '', 'project_2');
        $bd->zapros($_POST['login'], $_POST['password']);
        //Если база данных вернула не пустой ответ - значит пара логин-пароль правильная
        if (!empty($bd->rezalt)) {
            //Пишем в сессию информацию о том, что мы авторизовались:
            $_SESSION['auth'] = true;
            $_SESSION['hidden'] = 'hidden=""';
            //Пишем в сессию логин и id пользователя (их мы берем из переменной $user!):
            $_SESSION['id'] = $bd->rezalt['user_id']; 
            $_SESSION['login'] ='<a href="http://project2/?route=zakaz">'.$bd->rezalt['user_name'].'</a>';
            $_SESSION['loginbd'] = $bd->rezalt['user_name'];//BD
        }else{
            //Пользователь неверно ввел логин или пароль, выполним какой-то код.
            unset($_SESSION['error']);
            header('Location: /');
            exit;
        }
        unset($_SESSION['error']);
        header('Location: /');
        // header("Location: http://project2/?route=zakaz");
        exit;
    }else{
        $_SESSION['error'] = 'Поле пустое!';
    }

header('Location: /');
exit;

 ?>