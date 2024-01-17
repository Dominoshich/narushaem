<?php
session_start();
$_SESSION = null;
error_reporting(-1);
function debug($value)
{
	echo "<pre>";
	var_dump($value);
	echo "</pre>";
}

require_once('connection.php');

// Подключение к бд с помощью PDO
$regexp_valid = "/[^a-zA-Z0-9.,@а-яА-Я -]+/"; // регулярка для проверка входных данных
$regexp_valid_name = '/^[А-ЯЁа-яё]+(\s[А-ЯЁа-яё]+){0,2}$/u';
//'/^[А-ЯЁ][а-яё] [А-ЯЁ][а-яё]  [А-ЯЁ][а-яё]$/u';
$regexp_valid_phone = '/^\+\d{11}$/';// регулярка для проверка телефона
// Избовляюсь от нотисов в HTML, т.к. поля после неверного заполения таблицы не стираются и не надо вводить все данные заново
$login = '';
$name = '';
$email = '';
$password = '';
$phone = '';

$msg = "Поля могут содержать цифры, буквы, сивол - @";
$i = 0;
// Если отправилась форма методом POST начинаем проверку данных и заносим в БД. Форма на этой же странице.
// Если заходить на страницу просто по адресу а не отправкой формы то мы на нее поподаем методом GET
if ($_SERVER['REQUEST_METHOD'] == 'POST' && count($_POST) > 0) {
	// Обработка данных из массива POST
	$login = trim($_POST['login']);
	$email = strtolower(trim($_POST['email']));
	$name = trim($_POST['name']);
	$password = trim($_POST['pwd']);
	$phone = trim($_POST['phone']);
	var_dump($name);


	// проверка на корректность
	if (((bool)preg_match($regexp_valid, $login)) || $name == '') {
		$_SESSION['error_login'] = "Ошибка, login $login - не корректный";
		$i++;
	}

	if (((bool)!preg_match($regexp_valid_name, $name)) || $name == '' || strlen($name) >= 100 || strlen($name) <= 6) {
		$_SESSION['error_name'] = "Ошибка, name $name - не корректный";
		$i++;
	}
	if (((bool)preg_match($regexp_valid, $email)) || $email == '') {
		$_SESSION['error_log'] = "Ошибка, почта $email - не корректная";
		$i++;
	}

	if (((bool)preg_match($regexp_valid, $password)) || strlen($password) <= 3 || $password == '') {
		$_SESSION['error_pwd'] = "Ошибка, пароль не корректный";
		$i++;
	}
	if (!preg_match($regexp_valid_phone, $phone) || $phone == '') {
		$_SESSION['error_phone'] = "Ошибка, номер телефона не корректный";
		$i++;
	}
	if (((bool)preg_match($regexp_valid, $email)) || $email == '') {
		$_SESSION['error_email'] = "Ошибка, почта $email - не корректный";
		$i++;
	}


}
if ($i == 0) {
// Проверка на идентичность с БД (что бы пользователь с одими и теми же данными не зарестрировался два раза)
// Проверка логина
	$check_login = mysqli_query($connect, "SELECT * FROM `users` WHERE `login`='$login'");
	if ($check_login->num_rows > 0) {
		$res_check_login = mysqli_fetch_assoc($check_login);
	} else {
		$res_check_login = 0;
	}

	$check_email = mysqli_query($connect, "SELECT * FROM `users` WHERE `email`='$email'");
	if ($check_email->num_rows > 0) {
		$res_check_email = mysqli_fetch_assoc($check_email);
	} else {
		$res_check_email = 0;
	}


	if ($res_check_email > 0) {
		$msg_emaildouble = "Пользователь с такой почтой уже существует";
		$_SESSION['error_reg_emaildouble'] = $msg_emaildouble;

	}
	if ($res_check_login > 0) {
		$_SESSION['error_reg_logdouble'] = "Пользователь с таким логином уже существует";
	}
	if ($res_check_email > 0 || $res_check_login > 0) {
		header("Location: ./Registration.php ");

	}

	$result = mysqli_query($connect,
		"INSERT INTO users (login, password, fullname, phone, email) VALUES ('$login', '$password', '$name', '$phone', '$email')");
	if ($result) {
		$msg_success = "Регистрация успешно завершена";

		$check_user = mysqli_query($connect, "SELECT id FROM `users` WHERE `login`='$login'");
		if ($check_user->num_rows > 0) {
			$user = mysqli_fetch_assoc($check_user);


			$_SESSION['success'] = $msg_success;
			$_SESSION['user'] = [
				"id" => $user['id'],
				"name" => $user["fullname"],
				"login" => $user["login"]
			];
			header("Location: ./Applications.php ");
		} else {
			$msg_nothattime = 'Чево то не получилось добавить в бд ошибка какая-то';
			$_SESSION['error_reg_nothattime'] = $msg_nothattime;
			echo $login . "<br>";
			echo $name . "<br>";
			echo $email . "<br>";
			echo $password . "<br>";
			echo $phone . "<br>";
		}

	} else {
		header("Location: ./Registration.php ");
	}
	$_SESSION['error_reg'] = 'prooverka';
	debug($_SESSION);

}
?>
