<?php
    print_r($_POST);
    if($_POST['unick']=="")
    die("<script> alert('Nem adtad meg a felhasználónevet!')</script>");
    if($_POST['umail']=="")
    die("<script> alert('Nem adtad meg az email címed!')</script>");
    if($_POST['uszuldatum']=="")
    die("<script> alert('Nem adtad meg a születési dátumod!')</script>");
    if($_POST['upw']=="")
    die("<script> alert('Nem adtad meg a jelszavad!')</script>");
    
    include("kapcsolat.php");
    // var_dump($adb);
    $upw = md5($_POST['upw']);
     mysqli_query($adb, "                              
     INSERT INTO user (uid, umail, unick, upw, uszuldatum, udatum, uip, usession, ustatusz, ukomment) 
     VALUES           (NULL, '$_POST[umail]', '$_POST[unick]', '$upw', '$_POST[uszuldatum]', NOW(), '', '', '', '')
     
     ");
     die($_POST['upw']);
    mysqli_close($adb);
















?>
