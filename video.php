<?php
    session_start();

    function t1($val, $min, $max) {
        return ($val >= $min && $val <= $max);
    }

    require_once "connect.php";
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
        <link rel="stylesheet" type="text/css" href="maincontent.css">
        <link rel="stylesheet" type="text/css" href="errory.css">
        <link rel="stylesheet" type="text/css" href="paginacja.css">
        <link rel="stylesheet" type="text/css" href="posty.css">
        <title>HYC o podłoge</title>
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
                <div class="posty"> 
                    <p class="komunikat">Nad tym działem trwają jeszcze prace techniczne.</p>
                </div>
            <div class="oddzielnik"></div>
            </section>
            <div class="right_side_bar">
            <div class="oddzielnik"></div>
                <div class="panel_uzytkownika"><br />
                    <?php
                        if (isset($_SESSION['zalogowany']))
                        {
                            echo "<p>Witaj ".$_SESSION['user']."!</p>";

                            ?><br />
                            <p>W krótce dodamy tutaj więcej opcji,</p>
                            <p>Proszę o cierpliwość :)</p>
                            <p>Dzięki logowaniu możesz dodawać własne memy i pomóc w rozwijaniu portalu ;)</p><br />
                            
                            <a href="logout.php" style="color:white">Wyloguj się</a><br /><br /><?php
                        } else { ?>
                            <form action="login.php" method="post">
                            Login: <br /><input type="text" name="login"/><br/><br />
                            Hasło: <br /><input type="password" name="haslo" /><br/><br/>
                            <button type="submit">Zaloguj się</button>
                            <input type="button" onclick="location.href='rejestracja.php'" value="Zarejestruj się" />
                            <br /><br />
                        </form> <?php
                         }
                    ?>   
                </div>
                <div class="oddzielnik"></div>
                <div class="dodatek">
                       <?php
                            echo '<img src="banery/mem2.jpg">';
                        ?>
                    </div>
                    <div class="oddzielnik"></div>
                    <div class="dodatek">
                        <?php
                            echo '<img src="banery/mem1.jpg">';
                        ?>
                    </div>
                    <div class="oddzielnik"></div>
                    <div class="dodatek">
                        <?php
                            echo '<img src="banery/mem2.jpg">';
                        ?>
                    </div>
                    <div class="oddzielnik"></div>
                    <div class="dodatek">
                        <?php
                            echo '<img src="banery/mem1.jpg">';
                        ?>
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