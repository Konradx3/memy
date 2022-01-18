<?php
    session_start();
    if (!isset($_SESSION['zalogowany']))
    {
        header('Location: rejestracja.php');
        exit();
    }

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

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <link rel="stylesheet" type="text/css" href="errory.css">   
        <title>HYC o podłoge</title>
    </head>
    <body>

        <!-- Nagłówek -->
        <div class="header">
            <div class="logo_container">
                <h1>HYC</h1>
            </div>
            <nav class="navigation">
                <a href="index.php">Strona główna</a>
                <!--   <a href="najlepsze.php"><li>Najlepsze</li></a> -->
                <a href="video.php">Video</a>
                <a href="upload.php">Dodaj obrazek</a>
                <a href="uploadvid.php">Dodaj Video</a>
            </nav>
        </div>
        <!-- Koniec nagłówka -->

        <!-- Główna zawartość strony -->

        <div class="main_content">
            <section class="content">
                <div class="upload">
                    <form enctype="multipart/form-data" action="dodawanie.php" method="post" >
                        <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                        <p>Wpisz tytuł posta:</p>
                        <input type="text" name="opis" maxlength="35" size="25"/>
                        <input type="file" name="nazwa_pliku"/>
                        <input  class="" type="submit" name="submit" value="Wyślij" />
                        <?php 
                        if(isset($_SESSION['zapis'])) echo $_SESSION['zapis'];
                        unset($_SESSION['zapis']);
                        ?>
                    </form>
                </div>
            </section>

            <div class="right-side-bar">
                <div class="user-panel">
                    <?php
                    echo "<p>Witaj ".$_SESSION['user']."!</p>";
                    ?>
                    <p>W krótce dodamy tutaj więcej opcji,</p>
                    <p>Proszę o cierpliwość :)</p>
                    <p>Dzięki logowaniu możesz dodawać własne memy i pomóc w rozwijaniu portalu ;)</p><br />
                    <a href="logout.php" class="user-panel__btn">Wyloguj się</a>
                </div>

                
                    <div class="right-side-bar__add">
                        <?php
                            echo '<img src="banery/mem2.jpg">';
                        ?>
                    </div>
                    <div class="right-side-bar__add"> 
                       <?php
                            echo '<img src="banery/mem1.jpg">';
                        ?>
                    </div>

                    <div class="right-side-bar__add">
                        <?php
                            echo '<img src="banery/mem1.jpg">';
                        ?>
                    </div>
                    <div class="right-side-bar__add">
                        <?php
                            echo '<img src="banery/mem2.jpg">';
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