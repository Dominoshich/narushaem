<?php
if (!empty($_SESSION)) {
	session_destroy();
}
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png" />
		<link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png" />
		<link rel="icon" type="image/png" sizes="16x16" href=".favocon/favicon-16x16.png" />
		<link rel="manifest" href="/site.webmanifest" />
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5" />
		<meta name="msapplication-TileColor" content="#da532c" />
		<meta name="theme-color" content="#ffffff" />
		<title>Нарушений нет</title>

		<link rel="stylesheet" type="text/css" href="styles_reg.css" />
		<link rel="stylesheet" type="text/css" href="Header.css" />
	</head>
	<body>
		<!-- HEADER -->
		<header class="header">
			<div class="header-wrapper header">
				<div class="block-switch">
					<div class="block-1">
						<h2><a>НАРУШЕНИЙ НЕТ</a></h2>
						<nav class="nav">
							<ul>
								<li><a href="Applications.php" class="text-default">Заявления</a></li>
								<li><a href="AddApplications.php" class="text-default">Подать заявление</a></li>
							</ul>
						</nav>
					</div>
					<div class="wrap">
						<div class="block_2">
							<div class="authorization">
								<a href="Registration.php"><button class="reg">Регистрация</button></a>
                                <a href="Enter.php"><button class="enter">Вход</button></a>
							</div>
						</div>
					</div>
				</div>
				<div class="burger">
					<div class="line"></div>
				</div>
			</div>
		</header>

		<!-- MAIN -->

		<main>
			<div class="window-wrapper">
				<div class="window">
					<h1>Регистрация</h1>
					<form name="registrationForm" action="reg.php" method="post">
						<p class="column-punct<?php if (isset($_SESSION['auth'])){echo ' mgbtn';}?>">Логин: <input class="area" type="text" name="login" required /></p>
						<?php
						if (isset($_SESSION['error_login'])) {
							echo '<div class="wrong_data" ">Введен не корректный логин</div>';
						}
						unset($_SESSION['error_login']);
						?>
						<p class="column-punct<?php if (isset($_SESSION['auth'])){echo ' mgbtn';}?>">Пароль: <input class="area" type="password" name="pwd" minlength="6" required /></p>
						<?php
						if (isset($_SESSION['error_pwd'])) {
							echo '<div class="wrong_data" ">Введен не корректный пароль</div>';
						}
						unset($_SESSION['error_pwd']);
						?>
						<p class="column-punct<?php if (isset($_SESSION['auth'])){echo ' mgbtn';}?>">ФИО: <input class="area" type="text" name="name"required pattern="^[А-ЯЁа-яё]+(\s[А-ЯЁа-яё]+){0,2}$"   /></p>
						<?php
						if (isset($_SESSION['error_name'])) {
							echo '<div class="wrong_data" ">Введен не корректные ФИО</div>';
						}
						unset($_SESSION['error_name']);
						?>
						<p class="column-punct<?php if (isset($_SESSION['auth'])){echo ' mgbtn';}?>">Телефон: <input class="area" type="tel" name="phone" pattern="^\+\d{11}$" required /></p>
						<?php
						if (isset($_SESSION['error_phone'])) {
							echo '<div class="wrong_data" ">Введен не корректный номер телефона</div>';
						}
						unset($_SESSION['error_phone']);
						?>
						<p class="column-punct<?php if (isset($_SESSION['auth'])){echo ' mgbtn';}?>">Email: <input class="area" type="email" name="email" required /></p>
						<?php
						if (isset($_SESSION['error_email'])) {
							echo '<div class="wrong_data" ">Введен не корректный email</div>';
						}
						unset($_SESSION['error_email']);
						?>
						<?php
						if (isset($_SESSION['error_reg_emaildouble']) && isset($_SESSION['error_reg_logdouble'])) {
							echo '<div class="wrong_data" ">Пользователь с такой почтой и логином уже существуют</div>';
						}else{
							if (isset($_SESSION['error_reg_logdouble'])) {
								echo '<div class="wrong_data" ">Пользователь с таким логином уже существует</div>';
							}
							if (isset($_SESSION['error_reg_emaildouble'])) {
								echo '<div class="wrong_data" ">Пользователь с такой почтой уже существует</div>';
							}
                        }
						unset($_SESSION['error_reg_emaildouble']);
						unset($_SESSION['error_reg_logdouble']);
						?>
                        <p><input class="btn" type="submit" value="Зарегистрироваться" /></p>

					</form>
				</div>
			</div>

			<!-- MODAL WINDOW -->

			<div id="myModal" class="modal">
				<div class="modal-content">
					<span class="close">&times;</span>
					<div id="modalContent"></div>
				</div>
			</div>
		</main>
		<footer>
			<h3 class="respect">Ярик молодец!</h3>
		</footer>

		<!-- script burger -->
		<script>
			document.querySelector('.burger').addEventListener('click', function () {
				this.classList.toggle('active')
				document.querySelector('.nav').classList.toggle('open')
			})
		</script>
	</body>
</html>
