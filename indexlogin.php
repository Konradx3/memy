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
                                  
                                  $adres = $polaczenie->query("SELECT adresy, rozszerzenie, opis, addTime, user FROM grafiki ORDER BY `grafiki`.`addTime` DESC LIMIT $this_page_first_result, $results_per_page");
                    
                                  while($res = mysqli_fetch_array($adres)){
                                      $opis = $res[2];
                                      $wysw = 'grafiki/'.$res[0].'.'.$res[1];
                                      $dataczas = $res[3];
                                      $user =$res[4]
                                      ?><article>
                                      <div class="post">
                                        <div class="post__description"><?php echo $opis; ?>
                                            <div class="post__description--added"><?php echo $dataczas;?></div>
                                        </div>
                                      <!-- <div class="oddzielnikmaly"></div> -->
                                      <div class="obrazek>"><?php echo '<img src="'.$wysw.'">'; ?></div>

                                      <div class="like-bar">
                                          <div class="like-bar__btns">
                                        <button class='btn'>
                                            <svg xmlns="http://www.w3.org/2000/svg" 
                                            class="btn-icon btn-icon-plus" 
                                            fill="none" viewBox="0 0 24 24" 
                                            stroke="currentColor">
                                            <path stroke-linecap="round" 
                                            stroke-linejoin="round" 
                                            stroke-width="2" 
                                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                        <button class="btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" 
                                            class="btn-icon btn-icon-minus" 
                                            fill="none" viewBox="0 0 24 24" 
                                            stroke="currentColor">
                                            <path stroke-linecap="round" 
                                            stroke-linejoin="round" 
                                            stroke-width="2" 
                                            d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                            <p>Tutaj suma + i -</p>
                                        </div>
                                        <div class="like-bar__user">
                                            Dodano przez: <?php echo $user;?>
                                        </div>
                                      </div>

                                      </article><?php
                                  }
                                  ?>
                                  <div class="center">

                                <div class="pagination">
                                    <a href="index.php?page=1">Pierwsza</a>

                                    <?php 
                                    for( $i = 1; $i <= $number_of_pages; $i++ ) {
                                        $bold = ( $i == $page ) ? 'class="pagination__on" ' : '';
                                        if( t1( $i, ( $page -3 ), ( $page + 3 ) ) ) {       
                                        echo '<a ' . $bold . ' href="index.php?page=' . $i . '">' . $i . '</a>';
                                        }
                                    }
                                    ?> 
                                    <a href="index.php?page=<?php echo $number_of_pages; ?>">Ostatnia</a>
                                </div>
                                
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