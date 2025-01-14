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
        <div id='login'> 
            <?php
                if (!isset($_SESSION['uid'])) {
                    print "<input type='button' value='Belépés' id='btnlogin' onclick='location.href=\"./?p=login\"'>";
                }
                else
                { 
                    $user = mysqli_fetch_array(mysqli_query($adb , 
                        "SELECT * FROM user 
                        WHERE uid='$_SESSION[uid]'"));
                        if($user['uprofkep_nev']!="") $profilkep = "./profilkepek/$user[uprofkep_nev]";
                        else                          $profilkep = "alapprofilkep.jpg";

                        print "
                            <img src='./profilkepek/$user[uprofkep_nev]' style='height:36px;
                            border-radius:50%;'>
                            <a id='nev' href='./?p=adatlapom'>$_SESSION[unick]</a>
                            <input type='button' value='Kilépés' id='btnkilep' onclick='kisablak.location.href=\"./logout.php\"'>
                        ";
                }
        
            ?>
        </div>

        <?php
            if(isset($_GET['p'])) $p = $_GET['p'];
            else                  $p = "";
            if (!isset($_SESSION['uid']))
            {
                if($p=="")                  include("kezdolap.php");     else
                if ($p=="regisztracio")     include ("reg_form.php");    else
                if ($p=="login")            include ("login_form.php");  else
                                            include("404_kulso.php");
            }
            else
            {
                if ($p=="")                 include ("belsolap.php");    else
                if ($p=="adatlapom")        include("adatlap_form.php"); else
                                            include("404_belso.php");
            }
        ?>

        <br>
        <br>
        <iframe name='kisablak'></iframe>
    </body>
    
</html>

<?php
    mysqli_close($adb);
?>