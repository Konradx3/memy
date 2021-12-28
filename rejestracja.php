<?php

	session_start();
	
	if (isset($_POST['email']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//Sprawdź poprawność nickname'a
		$nick = $_POST['nick'];
		
		//Sprawdzenie długości nicka
		if ((strlen($nick)<6) || (strlen($nick)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick musi posiadać od 6 do 20 znaków!";
		}
		
		if (ctype_alnum($nick)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		
		// Sprawdź poprawność adresu email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		
		//Sprawdź poprawność hasła
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne!";
		}	

		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
		//Czy zaakceptowano regulamin?
		if (!isset($_POST['regulamin']))
		{
			$wszystko_OK=false;
			$_SESSION['e_regulamin']="Potwierdź akceptację regulaminu!";
		}				
		
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_nick'] = $nick;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
		if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Czy email już istnieje?
				$rezultat = $polaczenie->query("SELECT id FROM konta WHERE email='$email'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
				}		

				//Czy nick jest już zarezerwowany?
				$rezultat = $polaczenie->query("SELECT id FROM konta WHERE user='$nick'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_nick']="Istnieje już gracz o takim nicku! Wybierz inny.";
				}
				
				if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					
					if ($polaczenie->query("INSERT INTO konta VALUES (NULL, '$nick', '$haslo_hash', '$email')"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: witamy.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
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
                        <a href="indexlogin.php"><li>Strona główna</li></a>
                     <!--   <a href="najlepsze.php"><li>Najlepsze</li></a> -->
                        <a href="video.php"><li>Video</li></a>
                        <a href="rejestracja.php"><li>Dodaj obrazek</li></a>
                    </ul>
            </div>
        </div>
        <!-- Koniec nagłówka -->

        <!-- Główna zawartość strony -->

        <div class="main_content">
            <section class="content">
                <div class="oddzielnik"></div>
                <div class="rejestracja_box">
                    <form method="post"><br />
                    Nazwa użytkowinka: <br /><br /> <input type="text" value="<?php
                        if (isset($_SESSION['fr_nick']))
                        {
                            echo $_SESSION['fr_nick'];
                            unset($_SESSION['fr_nick']);
                        }
                    ?>" name="nick" /><br /><br />
                    <?php
                        if (isset($_SESSION['e_nick']))
                        {
                            echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
                            unset($_SESSION['e_nick']);
                        }
                    ?>
                    E-mail: <br /><br /> <input type="text" value="<?php
                        if (isset($_SESSION['fr_email']))
                        {
                            echo $_SESSION['fr_email'];
                            unset($_SESSION['fr_email']);
                        }
                    ?>" name="email" /><br /><br />
                    <?php
                        if (isset($_SESSION['e_email']))
                        {
                            echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                            unset($_SESSION['e_email']);
                        }
                    ?>
                    Hasło: <br /><br /> <input type="password"  value="<?php
                        if (isset($_SESSION['fr_haslo1']))
                        {
                            echo $_SESSION['fr_haslo1'];
                            unset($_SESSION['fr_haslo1']);
                        }
                    ?>" name="haslo1" /><br /><br />
                    <?php
                        if (isset($_SESSION['e_haslo']))
                        {
                            echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
                            unset($_SESSION['e_haslo']);
                        }
                    ?>		
                    Powtórz hasło: <br /><br /> <input type="password" value="<?php
                        if (isset($_SESSION['fr_haslo2']))
                        {
                            echo $_SESSION['fr_haslo2'];
                            unset($_SESSION['fr_haslo2']);
                        }
                    ?>" name="haslo2" /><br /><br />
                    <label>
                        <input type="checkbox" name="regulamin" <?php
                        if (isset($_SESSION['fr_regulamin']))
                        {
                            echo "checked";
                            unset($_SESSION['fr_regulamin']);
                        }
                            ?>/> Akceptuję regulamin
                    </label> 
                    <?php
                        if (isset($_SESSION['e_regulamin']))
                        {
                            echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
                            unset($_SESSION['e_regulamin']);
                        }
                    ?>	
                    <?php
                        if (isset($_SESSION['e_bot']))
                        {
                            echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
                            unset($_SESSION['e_bot']);
                        }
                    ?>	
                    <br /><br />
                    <input type="submit" value="Zarejestruj się" /><br /><br />
                </form>
                </div>
            </section>
            <div class="right_side_bar">
                <div class="oddzielnik"></div>
                <div class="dodatki">
                    <div class="logowanie">
                        <form action="login.php" method="post">
                            <br />
                            Login: <br /><input type="text" name="login"/><br/><br />
                            Hasło: <br /><input type="password" name="haslo" /><br/><br/>
                            <button type="submit">Zaloguj się</button>
                            <input type="button" onclick="location.href='rejestracja.php'" value="Zarejestruj się" />
                            <br /><br />
                        </form>
                        <?php 
                        if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
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