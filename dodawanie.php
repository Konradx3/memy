<?php
session_start();
if (!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    exit();
}
$user = $_SESSION['user'];

if(isset($_POST['submit'])){
    $file = $_FILES['nazwa_pliku'];
    $fileName = $file['name'];
    $fileSize = $file['size'];
    $fileTmpLoc = $file['tmp_name'];
    $fileError = $file['error'];
    $opis = $_POST['opis'];

    // dozwolone rozszerzenia jpg jpeg png
    $f = explode('.',$fileName); //oddziela ciag znakow pierwsze miejsce to moment w ktorym nastepuje rozdzielenie, 2 parametr to z jakiego ciagu znakow
    $fileExt = strtolower($f[1]); // smienia wielkosc znakow na male zeby uniknac JpG itd . $f funkcja z wyzej [1] miejsce w tablicy ktore ma zmienic (liczy od zera)

    $allowedExt = array('jpg','jpeg','png'); //definiuje ktore rozszerzenia maja byc dozwolone
    if(in_array($fileExt,$allowedExt)){
        if($fileSize<500000){
            
            $fileNewName = uniqid('PIC_',false);
            $miejsce_docelowe = 'grafiki/'.$fileNewName.'.'.$fileExt;
            move_uploaded_file($fileTmpLoc,$miejsce_docelowe);

            require_once "connect.php";
		        mysqli_report(MYSQLI_REPORT_STRICT);
            try{
              $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
                if ($polaczenie->query("INSERT INTO grafiki VALUES (NULL, '$fileNewName', '$opis', '$user', '$fileExt', now())"))
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
            
            }else{
              echo "Plik jest zbyt duży";
            }

    }else{
      $_SESSION['zapis'] = '<span>Uzupełnij poprawnie wszystkie pola.</span>';
      header('Location:upload.php');
    }
 }else{
  $_SESSION['zapis'] = '<span>Uzupełnij poprawnie wszystkie pola.</span>';
   header('Location:upload.php');
 }
?>