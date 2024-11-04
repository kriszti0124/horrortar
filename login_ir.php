<?php
session_start();
print_r($_POST);
include("kapcsolat.php");
$ip = $_SERVER['REMOTE_ADDR'];
$sess = substr(session_id() , 0, 8);
if( isset($_SESSION['uid'])) $uid = $_SESSION['uid'];
else                        $uid= 0;
$url = $_SERVER['REQUEST_URI'];
mysqli_query($adb , "
INSERT INTO naplo (nid, ndatum, nip, nsession, nuid) 
VALUES            (NULL, NOW(), '$ip', '$sess', '$uid')
");


$pw=md5($_POST['pw']);

print ($pw.  "<br>". $_POST['pw'] );

$userek = mysqli_query($adb , "
                    SELECT * FROM user
                    WHERE (umail='$_POST[email]' OR unick='$_POST[email]')
                    AND   upw='$pw'
                    
");
if(mysqli_num_rows($userek)==0)
{
    print "<script> alert('Hibás belépési adatok!')</script>";
}
else
{
    $user = mysqli_fetch_array($userek);
    $_SESSION['uid'] = $user['uid'];
    $_SESSION['unick'] = $user['unick'];
    
}







mysqli_close($adb);
print "<script> parent.location.href = './' </script>";
?>