<?php
session_start();
if ($_SESSION['user'] == '') {
	unset($_SESSION['user']);
	header('Location:./Enter.php');
}
function debug($value)
{
	echo "<pre>";
	var_dump($value);
	echo "</pre>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href=".favocon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>Нарушений нет</title>

    <link rel="stylesheet" type="text/css" href="styles_addApp.css"/>
    <link rel="stylesheet" type="text/css" href="Header.css"/>
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
                        <a href='logout.php'>
                            <button class='enter'>Выход</button>
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
            <h1>Заявление</h1>
            <form name="applicationForm" action="AddApplic.php" method="post">
                <p class="column-punct <?php if (isset($_SESSION['error_carNumber'])){echo 'mgbtn';}?>">
                    Номер машины: <input class="area" type="text" id="carNumber" name="carNumber" required minlength="6" maxlength="6" pattern="[АВЕКМНОРСТУХавекмнорстух]{1}\d{3}[АВЕКМНОРСТУХавекмнорстух]{2}" /></p>
				<?php
                if (isset($_SESSION['error_carNumber'])){
					echo '<div class="wrong_data" ">Введен не корректный номер автомобиля</div>';
				}
				unset($_SESSION['error_carNumber']);
				?>
                <p class="column-punct">Описание: <textarea class="description-area" name="description" rows="4" required minlength="15"></textarea></p>
                <div>
                    <input class="btn" type="submit" value="Подать заявление"/>
                </div>
            </form>
        </div>
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

    function validateForm() {
        var carNumberInput = document.getElementById('carNumber');
        var carNumberRegex = /[АВЕКМНОРСТУХ\d]{1}\d{3}[АВЕКМНОРСТУХ\d]{2}/u;

        if (!carNumberRegex.test(carNumberInput.value)) {
            alert('Введите номер в формате Х192ХХ');
            return false;
        }

        return true;
    }
</script>
</body>
</html>

		