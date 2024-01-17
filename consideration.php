<?php
function debug($value)
{
	echo "<pre>";
	var_dump($value);
	echo "</pre>";
}
debug($_POST);
require_once('connection.php');
if (isset($_POST['agree'])) {
	$id = $_POST['agree'];
	$sql = "UPDATE statements SET status = 'Принято' WHERE id = '$id'";
	if ($conn->query($sql) === TRUE) {
		echo "Статус успешно обновлен";
	} else {
		echo "Ошибка при обновлении статуса: " . $conn->error;
	}
}
if (isset($_POST['dont-agree'])) {
	$id = $_POST['dont-agree'];
	$sql = "UPDATE statements SET status = 'Отклонено' WHERE id = '$id'";
	if ($conn->query($sql) === TRUE) {
		echo "Статус успешно обновлен";
	} else {
		echo "Ошибка при обновлении статуса: " . $conn->error;
	}
}
header("Location: ./Applications-admin.php ");

