<?php
    session_start();
    if (!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }
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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <link rel="stylesheet" type="text/css" href="errory.css">       
        <link rel="stylesheet" type="text/css" href="paginacja.css">
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
                <div class="posty"> 
                <?php
                                $results_per_page = 10;
                                $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

                                $sql="SELECT adresy, rozszerzenie, opis, addTime FROM grafiki ORDER BY `grafiki`.`addTime` DESC";
                                $result = mysqli_query($polaczenie, $sql);
                                $number_of_results = mysqli_num_rows($result);
                                
                                $number_of_pages = ceil($number_of_results/$results_per_page);
                                
                                if (!isset($_GET['page'])) {
                                    $page = 1;
                                  } else {
                                    $page = $_GET['page'];
                                  }
                                
                                  $this_page_first_result = ($page-1)*$results_per_page;
                                  
                                  $adres = $polaczenie->query("SELECT adresy, rozszerzenie, opis, addTime FROM grafiki ORDER BY `grafiki`.`addTime` DESC LIMIT $this_page_first_result, $results_per_page");
                    
                                  while($res = mysqli_fetch_array($adres)){
                                      $opis = $res[2];
                                      $wysw = 'grafiki/'.$res[0].'.'.$res[1];
                                      $dataczas = $res[3];
                                      ?><article>
                                      <div class="post">
                                      <div class="opis"><?php echo $opis; ?>
                                      <div class="dodanie" style="width: 15%; height: auto; float: right; font-size: 15px; text-align: center;"><?php echo $dataczas;?></div>
                                      </div>
                                      <div class="oddzielnikmaly"></div>
                                      <div class="obrazek>"><?php echo '<img src="'.$wysw.'">'; ?></div>
                                      </div><div class="oddzielnik"></div>
                                      </article><?php
                                  }
                                  ?>
                                  <div class="center">
                                  <ul class="pagination">
                                    <li><a href="index.php?page=1">Pierwsza</a></li>

                                        <?php 
                                            for( $i = 1; $i <= $number_of_pages; $i++ ) {

                                                $bold = ( $i == $page ) ? 'style="color: rgb(245, 157, 99); background-color: rgb(6, 65, 65);"' : '';
                                                if( t1( $i, ( $page -3 ), ( $page + 3 ) ) ) {
                            
                                                    echo '<li><a ' . $bold . ' href="index.php?page=' . $i . '">' . $i . '</a></li>';
                            
                                                }
                                            }
                                        ?> 
                                  <li><a href="index.php?page=<?php echo $number_of_pages; ?>">Ostatnia</a></li>
                              </ul>
                                </div>
                </div>
            <div class="oddzielnik"></div>
            </section>
            <div class="right_side_bar">
            <div class="oddzielnik"></div>
                <div class="panel_uzytkownika"><br />
                    <?php
                    echo "<p>Witaj ".$_SESSION['user']."!</p>";
                    ?><br />
                    <p>W krótce dodamy tutaj więcej opcji,</p>
                    <p>Proszę o cierpliwość :)</p>
                    <p>Dzięki logowaniu możesz dodawać własne memy i pomóc w rozwijaniu portalu ;)</p><br />
                    <a href="logout.php" style="color:white">Wyloguj się</a><br /><br />
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