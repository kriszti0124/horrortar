<?php
    session_start() ;
    include("kapcsolat.php");

    $ip = $_SERVER['REMOTE_ADDR'];
    $sess = substr(session_id() , 0, 8);

    if( isset($_SESSION['uid'])) $uid = $_SESSION['uid'];
    else                         $uid = 0;

    $url = $_SERVER['REQUEST_URI'];

    mysqli_query($adb , "
        INSERT INTO naplo (nid, ndatum, nip, nsession, nuid, nurl) 
        VALUES            (NULL, NOW(), '$ip', '$sess', '$uid', '$url')
    ");
?>
<html>
    <style>
        iframe{
            display: none;
        }
        
        div#login {
            text-align:right;
        } 

        #btnlogin {
            text-align:center;
            width: 80px;
            background-color:black;
            color:white;
        }

        #btnkilep { 
            text-align:center;
            width: 80px;
            background-color:black;
            color:white;
        }

        #nev {
            color:white;
        }
    </style>

    <body>
        <?php
            include("navigacio.php");
            if(isset($_GET['p'])) $p = $_GET['p'];
            else                  $p = "";
            if (!isset($_SESSION['uid']))
            {
                if ($p=="")                 include ("kezdolap.php");     else
                if ($p=="regisztracio")     include ("reg_form.php");     else
                if ($p=="login")            include ("login_form.php");   else
                                            include ("404_kulso.php");
            }
            else
            {
                if ($p=="")                 include ("belsolap.php");     else
                if ($p=="adatlapom")        include ("adatlap_form.php"); else
                if ($p=="filmek")           include ("filmek.php");       else
                if ($p=="feltoltes")        include ("filmfeltoltes_form.php");else
                                            include ("404_belso.php");
            }
        ?>

        <br>
        <br>
        <iframe name='kisablak'></iframe>
    </body>
</html>
