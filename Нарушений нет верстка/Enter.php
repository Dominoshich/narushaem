<?php
if (!empty($_SESSION)) {
    session_destroy();
}
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png"/>
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png"/>
    <link rel="icon" type="image/png" sizes="16x16" href=".favocon/favicon-16x16.png"/>
    <link rel="manifest" href="/site.webmanifest"/>
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5"/>
    <meta name="msapplication-TileColor" content="#da532c"/>
    <meta name="theme-color" content="#ffffff"/>
    <title>Нарушений нет</title>

    <link rel="stylesheet" type="text/css" href="styles_enter.css"/>
    <link rel="stylesheet" type="text/css" href="Header_2.css"/>
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
                        <a href="Registration.php">
                            <button class="reg">Регистрация</button>
                        </a
                        ><a href="Enter.php">
                            <button class="enter">Вход</button>
                        </a>
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
            <h1>Вход</h1>
            <form name="registrationForm" action="authorization.php" method="post">
                <p class="column-punct  <?php if (isset($_SESSION['auth'])){echo 'mgbtn';}?>">
                    Логин: <input class="area" type="text" name="login" pattern="[a-zA-Z0-9]+" required/></p>
                <p class="column-punct <?php if (isset($_SESSION['auth'])){echo 'mgbtn';}?>">
                    Пароль: <input class="area" type="password" name="pwd" minlength="6"  required/></p>
				<?php
				if (isset($_SESSION['auth'])) {
					echo '<div class="wrong_data" ">Введен не корректный номер автомобиля</div>';
				}
				unset($_SESSION['auth']);
				?>
                <p><input class="btn" type="submit" value="Войти"/></p>
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
