<?php
session_start();

if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
    header('Location: index.php');
    // exit();
}

require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno!=0)
{
    echo "Error".$polaczenie->connect_errno;
}
else
{

    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");


    if ($rezultat = @$polaczenie->query(
    sprintf("SELECT * FROM konta WHERE user='%s'",
    mysqli_real_escape_string($polaczenie,$login))))
        {
            $ilu_userow = $rezultat->num_rows;
            if ($ilu_userow>0)
            {
                $wiersz = $rezultat->fetch_assoc();
                if (password_verify($haslo, $wiersz['pass']))
                {
                    $_SESSION['zalogowany'] = true;
                    $_SESSION['id'] = $wiersz['id'];
                    $_SESSION['user'] = $wiersz['user']; /* wpisac dane do wyswietlania */
                    $_SESSION['email'] = $wiersz['email'];

                    unset($_SESSION['blad']);
                    $rezultat->free_result();
                    header('Location: indexlogin.php');
                }
                else {
                    $_SESSION['blad'] = '<span class="login__error">Nieprawidłowy login lub hasło.</span>
                    <script type="text/javascript"> 
                        document.querySelector(".modal-background").classList.add("bg-active");
                        window.setTimeout(function(){document.querySelector(".login__error").style.display = "none";},4000)
                    </script>';
                    header('Location: index.php');
                    
                }
            } else {
                $_SESSION['blad'] = '<span class="login__error">Nieprawidłowy login lub hasło.</span>
                <script type="text/javascript"> 
                    document.querySelector(".modal-background").classList.add("bg-active");
                    window.setTimeout(function(){document.querySelector(".login__error").style.display = "none";},4000)
                </script>';
                header('Location: index.php');
            }
        }

$polaczenie->close();
}

?>