<?php
session_start();
if (!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    exit();
}
$user = $_SESSION['user'];

if(isset($_POST['submit'])){
    $opis = $_POST['opis'];

    $adres = $_POST['link'];
    preg_match('#(.*)watch\?v=(.+)#',$adres,$matches);
    $video_id = $matches[2];
    
    require_once "connect.php";

    try{
      $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
      if ($polaczenie->query("INSERT INTO video VALUES (NULL, '$user', '$opis', '$adres', '$video_id', now())"))
          {
            $_SESSION['udanyzapis']=true;
          }
          else
          {
            throw new Exception($polaczenie->error);
          }
    }catch(Exception $e){
      echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności!</span>';
      echo '<br />Informacja developerska: '.$e;
    }
    $polaczenie->close();
    header('Location:indexlogin.php?succes=true');

  }else {
    echo "coś poszło kurwa nie tak";
 }
?>