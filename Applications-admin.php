<?php
session_start();
if ($_SESSION['user']['login'] != 'copp') {
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
$id = $_SESSION['user']['id'];
$sql = "SELECT narushaem.users.fullname, narushaem.statements.* FROM narushaem.statements INNER JOIN narushaem.users ON narushaem.statements.user_id = narushaem.users.id ORDER BY narushaem.statements.status ASC, narushaem.statements.id DESC; ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// Вывод списка заявок
	while ($row = $result->fetch_assoc()) {
		$zayavki[] = $row;
	}
} else {
	echo "Нет доступных заявок.";
}
// Закрытие соединения с базой данных
$conn->close();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href="./favicon/apple-touch-icon.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="./favicon/favicon-32x32.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href=".favocon/favicon-16x16.png"
    />
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5" />
    <meta name="msapplication-TileColor" content="#da532c" />
    <meta name="theme-color" content="#ffffff" />
    <title>Нарушений нет</title>

    <link
      rel="stylesheet"
      type="text/css"
      href="styles_applications-admin.css"
    />
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
                <li>
                  <a href="Applications.php" class="text-default">Заявления</a>
                </li>
                <li>
                  <a href="AddApplications.php" class="text-default"
                    >Подать заявление</a
                  >
                </li>
              </ul>
            </nav>
          </div>
          <div class="wrap">
            <div class="block_2">
              <div class="authorization">
                  <a href='logout.php'><button class='enter'>Выход</button></a>
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
        <div class="block-title">
          <h1 class="app-title">Заявления</h1>
        </div>
        <div class="applications-wrapper">
	        <?php
	        $counter = 0;
	        foreach ($zayavki as $application) :
		        if ($counter % 3 == 0) {
			        echo '<div class="line-for-three">';
		        }
		        ?>
                <div class="application">
                    <div class="status<?php switch ($application['status']) {
				        case 'Отклонено':
					        echo ' status_disagree';
					        break;
				        case 'Принято':
					        echo ' status_agree';
					        break;
			        }  ?> "><?= $application['status'] ?></div>
                    <!-- Добавленный блок .status -->
                    <div class="first-storke">
                        <div class="line-id">
                            <p class="id-title">ФИО:</p>
                            <p class="id"><?= $application['fullname'] ?></p>
                        </div>
                        <div class="line-number">
                            <p class="id-title">№:</p>
                            <p class="number"><?= $application['vehiclenumber'] ?></p>
                        </div>
                    </div>
                    <div class="description <?php if ($application['status'] == 'Отклонено') {
                        echo " description2";
                    } elseif ($application['status'] == 'Принято') {
                        echo " description2";
                    }?>">
                        <div class="scroll-container">
                            <p>
						        <?= $application['description'] ?>
                            </p>
                        </div>
                    </div>
                    <?php
	                if ($application['status'] == 'Новое'):
	                ?>


                        <form  class="line-agree" method="post" action="consideration.php">
                          
                            <button class="dont-agree" name="dont-agree" value="<?= $application['id'] ?>">Отклонить</button>
                            <button class="agree" name="agree" value="<?= $application['id'] ?>">Подтвердить</button>
                  
                        </form>
                     

                    <?php
                    endif;
                    ?>

                </div>
		        <?php
		        $counter++;

		        if ($counter % 3 == 0) {
			        echo '</div>'; // закрываем блок "line-for-three"
		        }

	        endforeach;

	        // Если количество блоков "application" не кратно 3, закрываем последний блок "line-for-three"
	        if ($counter % 3 != 0) {
		        echo '</div>';
	        }
	        ?>

        </div>
      </div>
    </main>
    <footer>
      <h3 class="respect">Ярик молодец!</h3>
    </footer>

    <!-- script burger -->
    <script>
        document.querySelector(".burger").addEventListener("click", function () {
            this.classList.toggle("active");
            document.querySelector(".nav").classList.toggle("open");
        });

        document.querySelectorAll(".scroll-container").forEach(function (container) {
            container.addEventListener("mouseleave", function () {
                this.scrollTop = 0;
            });
        });
    </script>
  </body>
</html>
