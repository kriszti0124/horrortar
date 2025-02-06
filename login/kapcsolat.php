<?php
    $adb = mysqli_connect("localhost", "root", "", "horror");

    function randomstring($h)
    {
        $c = "0123456789qwertzuiopasdfghjklyxcvbnm";
        $s = "";
        for( $i = 0; $i < $h; $i++ ) $s .= substr( $c , rand(0,strlen($c)-1) , 1 );
        return $s;
    }
?>