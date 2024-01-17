<?php
session_start();
require_once('connection.php');
$login = trim($_POST['login']);
$pwd = trim($_POST['pwd']);


$check_user=mysqli_query($connect, "SELECT * FROM `users` WHERE `login`='$login' AND `password`='$pwd'");


//если количество записей, выбранных из БД, больше нуля,
//т.е. найден пользователь с введенным логином и паролем
//(поле login в БД должно быть уникальным)

if($check_user->num_rows>0){
//преобразуем результаты выполнения запроса в массив
$user=mysqli_fetch_assoc($check_user);

//создаем в сессии переменную us с - массив с результатамивыполнения запроса
$_SESSION['user']=[
"id"=>$user['id'],
"name"=>$user["fullname"],
"login"=>$user["login"]
];
if ($user["login"] == 'copp') {
    header('Location: ./Applications-admin.php');
} else{
    header('Location: ./Applications.php');
}
//и перенаправляем пользователя на страницу с его заявками
}

//в противном случае
else{
    $_SESSION['auth'] = 'Логи или пароль неправильный';
    header('Location: ./Enter.php');
}
?>
