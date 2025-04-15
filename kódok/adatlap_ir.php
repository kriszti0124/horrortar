<?php
    session_start();
    include("randomstring.php");

    print "<hr>";

    include( "kapcsolat.php" );

    $toltottefel = false;
    $kepnev = "";
    $eredetikepnev = "";

    if(isset($_FILES['profkep']) && $_FILES['profkep']["name"] != "") { 
        
        $kepnev = $_SESSION['uid'] . "_" . date( "ymdHis" ) ."_" . randomstring(10);
        $kepadat = $_FILES['profkep'];

        if ($kepadat['type'] == "image/jpeg") {
            $kiterj = ".jpg";
        } else if ($kepadat['type'] == "image/png") {
            $kiterj = ".png";
        } else {
            die("<script> alert('A kép csak jpg vagy png lehet!')</script>");
        }

        $kepnev .= $kiterj;
        move_uploaded_file($kepadat['tmp_name'], "./profilkepek/" . $kepnev);
        $eredetikepnev = $kepadat['name'];
        
        mysqli_query($adb, "
            UPDATE user 
            SET    umail = '$_POST[umail]',
                   unick = '$_POST[unick]',
                   uszuldatum = '$_POST[uszuldatum]',
                   uprofkep_nev = '$kepnev',
                   uprofkep_eredetinev = '$eredetikepnev'
            WHERE  uid = '$_SESSION[uid]'
        ");
        $_SESSION['unick'] = $_POST['unick'];
        $toltottefel = true;
    }

    if (!$toltottefel) {
        if ($_POST['unick'] == "") {
            die("<script> alert('Felhasználónév megadása kötelező!')</script>") ;
        }

        mysqli_query($adb, "
            UPDATE user 
            SET    umail = '$_POST[umail]',
                   unick = '$_POST[unick]',
                   uszuldatum = '$_POST[uszuldatum]'
            WHERE  uid = '$_SESSION[uid]'
        ");
        $_SESSION['unick'] = $_POST['unick'];
    }

    print "
        <script>
            alert('Adataidat módosítottuk');
            parent.location.href = parent.location.href;
        </script>
    ";

    mysqli_close($adb);
?>