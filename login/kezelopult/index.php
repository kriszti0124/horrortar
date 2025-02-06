<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>Document</title>
</head>

<style>
    body{
        margin: 0;
    }

    div#menu{
        background-color: rgb(80, 73, 73);
        text-align: center;
    }

    div#menu a{
        display: inline-block;
        width: 200px;
        text-decoration: none;
        color: white;
    }

    div#menu a:hover{
        color: black;
    }
</style>

<body>
    <div id='menu'>
        <a href='../' tartget=_blank>horrortar.hu</a>
        <a href='./?p=felhasznalok'>Felhasználók</a>
        <a href='./?p=mufajok'>Műfajok szerkesztése</a>
        <a href='./?p=ertekelesek'>Értékelések áttekintése</a>
        <a href=''>Nem tudom...</a>
    </div>

    <div id='tartalom'>
        <?php
            if( isset($_GET['p']) ) $p = $_GET['p'] ;
            else                    $p = ""         ;
            if( $p=="felhasznalok")       include( "felhasznalok.php" ) ;
            if( $p=="mufajok")            include( "mufajok.php" )      ;
            if( $p=="ertekelesek")        include( "ertekelesek.php" )  ;
        ?>
    </div>
</body>
</html>