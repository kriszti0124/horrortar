<?php
    session_start();
    print_r( $_POST );

    print "<hr>";

    print_r( $_FILES );

    include( "kapcsolat.php" );

    $kepnev = $_SESSION['uid'] . "_" . date( "ymdHis" ) ."_" . randomstring(10);
    $kepadat = $_FILES['profkep'];

    if ( $kepadat['type']=="image/jpeg" ) $kiterj = ".jpg";    else
    if ( $kepadat['type']=="image/png"  )  $kiterj = ".png";   else
    die( "<script> alert('A kép csak jpg vagy png lehet!')</script>" );

    $kepnev .= $kiterj;
    move_uploaded_file($kepadat['tmp_name'],"./profilkepek/". $kepnev);
    $eredetikepnev = $kepadat['name'];
    print "<br>". $kepnev;

    if ( $_POST['unick']=="" ) die("<script> alert('Felhasználónév?')</script>");
    
    mysqli_query( $adb, "
        UPDATE user 
        SET    umail                = '$_POST[umail]' ,
               unick                = '$_POST[unick]' ,
               uszuldatum           = '$_POST[uszuldatum]' ,
               uprofkep_nev         = '$kepnev'  ,
               uprofkep_eredetinev  = '$eredetikepnev'
        WHERE  uid                  = '$_POST[uid]'
    " );

    $_SESSION['unick'] = $_POST[unick];

    print "
        <script>
            alert('Adataidat módosítottuk')
            parent.location.href = parent.location.href
        </script>
    ";

    mysqli_close($adb);
?>