<?php
session_start();
error_reporting(-1);

function del_session(){
    $tempusr = $_SESSION['user'];
    session_unset();
    $_SESSION['user'] = $tempusr;
}
if ($_SESSION['user']== '') {
    unset($_SESSION['user']);
    header('Location:./Enter.php');
}

function debug($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}
require_once('connection.php');
// Подключение к бд с помощью PDO
$user_id = $_SESSION['user']['id'];

$regexp_valid = '/^[А-ЯA-Z]\d{3}[А-ЯA-Z]$/u'; // регулярка для проверка входных данных
$regexp_valid_carNumber = '/^[АВЕКМНОРСТУХ\d]{1}\d{3}[АВЕКМНОРСТУХ\d]{2}$/u';;
// Избовляюсь от нотисов в HTML, т.к. поля после неверного заполения таблицы не стираются и не надо вводить все данные заново

$carNumber = '';
$description = '';

$i=0;
// Если отправилась форма методом POST начинаем проверку данных и заносим в БД. Форма на этой же странице.
// Если заходить на страницу просто по адресу а не отправкой формы то мы на нее поподаем методом GET
if($_SERVER['REQUEST_METHOD'] == 'POST' && count($_POST) > 0){
    // Обработка данных из массива POST
    $description = trim($_POST['description']);
    $carNumber = strtoupper(trim($_POST['carNumber']));
    // проверка на корректность
    if(((bool)preg_match($regexp_valid_carNumber, $carNumber)) || $carNumber  == '' || !strlen($carNumber) == 6){
        $_SESSION['error_carNumber'] = "Ошибка, номер машины $carNumber - не корректный";
        $i++;
    }
    echo $i;

}
if ($i==0){
// Проверка на идентичность с БД (что бы пользователь с одими и теми же данными не зарестрировался два раза)
// Проверка логина

    $result = mysqli_query ($connect,"INSERT INTO statements (user_id, vehiclenumber, description) VALUES ('$user_id', '$carNumber', '$description')");
    if($result){
        $msg_success = "Регистрация успешно завершена";
        $_SESSION['success']=$msg_success;

    }else{
        $msg_nothattime = 'Чево то не получилось добавить в бд ошибка какая-то';
        $_SESSION['error_reg_nothattime']=$msg_nothattime;
    }
    del_session();
    header("Location: ./Applications.php ");


}else{
    header("Location: ./AddApplications.php ");
}
//debug($_SESSION);

//debug($_SESSION);
?>
