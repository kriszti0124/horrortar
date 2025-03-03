<?php
    session_start();
    include_once("kapcsolat.php");
    
    if($_POST['unick']=="")
    die("<script> alert('Nem adtad meg a felhasználónevet!')</script>");

    if($_POST['umail']=="")
    die("<script> alert('Nem adtad meg az email címed!')</script>");

    if($_POST['uszuldatum']=="")
    die("<script> alert('Nem adtad meg a születési dátumod!')</script>");

    if($_POST['upw']=="")
    die("<script> alert('Nem adtad meg a jelszavad!')</script>");
    
    $upw = md5($_POST['upw']);

    mysqli_query($adb, "                              
        INSERT INTO user (uid, umail, unick, upw, uszuldatum, udatum, uip, usession, ustatusz, ukomment) 
        VALUES           (NULL, '$_POST[umail]', '$_POST[unick]', '$upw', '$_POST[uszuldatum]', NOW(), '', '', '', '')
    ");
    
    if(!empty($_POST['unick']) && !empty($_POST['umail']) && !empty($_POST['uszuldatum']) && !empty($_POST['upw']) ) {
         echo "<script>alert('Sikeres regisztráció!')</script>";
    };
    
    $user_result = mysqli_query($adb, "SELECT unick, umail FROM user ORDER BY uid DESC LIMIT 1");

    $user_row = mysqli_fetch_assoc($user_result);

    $user_name = $user_row['unick'];
    $user_email = $user_row['umail'];

    $from = "info@horrortar.hu";
    $from_name = "Horrortár";
    $subject = "Üdvözlünk a Horrortárban!";

    $message = "
        Kedves ".$_POST['unick'].",

        Üdvözlünk a Horrortár közösségében!
        Nagyon örülünk, hogy csatlakoztál hozzánk, és izgatottan várjuk a filmekről való véleményed.
            Ha bármilyen kérdésed van, ne habozz írni nekünk!

            Köszönjük, hogy minket választottál!

            Üdvözlettel,
            A horrortar.hu Csapata
        ";

    $headers = "From: ".$from_name." <".$from.">"."\r\n";
    $headers .= "Reply-To: ".$from."\r\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n";  

    if(mail($_POST['umail'], $subject, $message, $headers)) {
        echo "<script> alert('A köszöntő e-mail sikeresen elküldve!') </script>";
    }
    else {
        echo "<script> alert('Hiba történt az e-mail küldésekor.') </script>";
        }
    mysqli_close($adb);
?>
