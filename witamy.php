<?php

	session_start();
	
	if (!isset($_SESSION['udanarejestracja']))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['udanarejestracja']);
	}
	
	//Usuwanie zmiennych pamiętających wartości wpisane do formularza
	if (isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
	if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
	if (isset($_SESSION['fr_haslo1'])) unset($_SESSION['fr_haslo1']);
	if (isset($_SESSION['fr_haslo2'])) unset($_SESSION['fr_haslo2']);
	if (isset($_SESSION['fr_regulamin'])) unset($_SESSION['fr_regulamin']);
	
	//Usuwanie błędów rejestracji
	if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
	if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	if (isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
	if (isset($_SESSION['e_regulamin'])) unset($_SESSION['e_regulamin']);
	if (isset($_SESSION['e_bot'])) unset($_SESSION['e_bot']);
	
?>
<!doctype html>
<html>
    <head>
        <!-- strona kodowa strony -->
        <meta charset="UTF-8" />
        <!-- opis strony -->
        <meta name="Description" content="opis strony" />
        <!-- słowa kluczowe -->
        <meta name="Keywords" content="klucz1, klucz2, klucz3" />
        <link rel="stylesheet" type="text/css" href="header.css">
        <link rel="stylesheet" type="text/css" href="footer.css">
        <link rel="stylesheet" type="text/css" href="main_content.css">
        <link rel="stylesheet" type="text/css" href="errory.css">
        <title>Memy</title>
    </head>
    <body>

        <!-- Nagłówek -->
        <div class="header">
            <div class="inner_header">
                <div class="logo_container">
                <h1><strong>HYC</strong></h1></div>
                    <ul class="navigation">
                        <a href="index.php"><li>Strona główna</li></a>
                     <!--   <a href="najlepsze.php"><li>Najlepsze</li></a> -->
                        <a href="video.php"><li>Video</li></a>
                        <a href="upload.php"><li>Dodaj obrazek</li></a>
                    </ul>
            </div>
        </div>
        <!-- Koniec nagłówka -->

        <!-- Główna zawartość strony -->

        <div class="main_content">
            <section class="content">
                <div class="oddzielnik"></div>
               <a href="index.php">Dziękujemy za rejestrację w serwisie. Możesz się zalogować.

                <div class="oddzielnik"></div>
            </section>
            <div class="oddzielnik"></div>
            <div class="right_side_bar">
                <div class="dodatki">
                    <div class="oddzielnik"></div>
                    <div class="reklama">
                       <p>reklama</p>
                    </div>
                    <div class="oddzielnik"></div>
                    <div class="dodatek1">
                        <p>śmieszne</p>
                    </div>
                    <div class="oddzielnik"></div>
                    <div class="dodatek2">
                        <p>słabe</p>
                    </div>
                    <div class="oddzielnik"></div>
                    <div class="dodatek3">
                        <p>kozak</p>
                    </div>
                    <div class="oddzielnik"></div>
                </div>
            </div>
        </div>

        <!-- Koniec zawartości strony -->

        <!-- Stopka -->
        <div class="footer">
            <div class="inner_footer">
                <div class="footer_third">
                    <h1>Kontakt</h1>
                    <a>E-mail: hyc@gmail.com</a>
                    <a href="regulamin.php">Regulamin</a>
                </div>
                <div class="footer_third">
                    <h1>Poszukujemy:</h1>
                    <a>- osobę od front-end'u</a>
                    <a>która chciałaby mieć udział</a>
                    <a>w tworzeniu serwisu.</a>
                    <a>Juniorzy mile widziani</a>
                </div>
            </div>
        </div>

        <!-- Koniec stopki -->

    </body>
</html>