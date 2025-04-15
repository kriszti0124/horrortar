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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Horrortár</title>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        height: 100vh;
        background: url(background.jpg) no-repeat;
        background-size: cover;
        background-position: center;
    }

    li {
        list-style: none;
    }
    
    a {
        text-decoration: none;
        color: #fff;
        font-size: 1rem;
    }

    .dropdown_menu {
        display: none;
        position: absolute;
        right: 2rem;
        top: 60px;
        height: 0;
        width: 300px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        border-radius: 10px;
        overflow: hidden;
        transition: height .2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .dropdown_menu.open {
        height: 280px;
        box-shadow: 0 0 30px rgba(0, 0, 0, .5);
        z-index: 1000;
    }

    .dropdown_menu li {
        padding: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dropdown_menu .action_btn {
        width: 100px;
        display: flex;
        justify-content: center;
    }

    /*section#hero {*/
    /*    height: calc(100vh - 60px);*/
    /*    display: flex;*/
    /*    flex-direction: column;*/
    /*    align-items: center;*/
    /*    justify-content: center;*/
    /*    text-align: center;*/
    /*    color: #fff;*/
    /*}*/

    /*#hero h1 {*/
    /*    font-size: 3rem;*/
    /*    margin-bottom: 1rem;*/
    /*}*/
    
    .about{
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center
    }
        
    .about .content img {
        height: 450px;
        width: 450px;
        max-width: 100%;
        border-radius: 50%;
    }
        
    .text {
        width: 550px;
        max-width: 100%;
        padding: 0 10px;
    }
        
    .content {
        width: 1280px;
        max-width: 95%;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-around;
    }
        
    .text h2 {
        color: #fff;
        font-size: 75px;
        margin-bottom: 20px;
        text-transform: capitalize;
    }
        
    .text h5 {
        color: #fff;
        font-size: 25px;
        margin-bottom: 25px;
        letter-spacing: 2px;
    }
        
    .text p {
        color: #070A11;
        font-size: 18px;
        line-height: 28px;
        letter-spacing: 1px;
        margin-bottom: 45px;
    }
    
    @media screen and (max-width: 1180px) {
        .about {
            width: 100%;
            height: auto;
            padding: 70px 0px;
        }
    }

    @media(max-width: 992px) {
        .navbar .links,
        .navbar .action_btn {
            display: none;
        }

        .navbar .toggle_btn {
            display: block;
        }

        .dropdown_menu {
            display: block;
        }
        
        .about .content img {
            margin-bottom: 35px;
        }
            
        .text h1 {
            font-size: 60px;
            margin-bottom: 25px;
        }
    }

    @media(max-width: 576px) {
        .dropdown_menu {
            left: 2rem;
            width: unset;
        }
        
        .about .content img {
            height: 300px;
            width: 300px;
            margin-bottom: 35px;
        }
            
        .text h1 {
            font-size: 60px;
            margin-bottom: 25px;
        }
    }
    
</style>

<body>

    <!--<main>-->
    <!--    <section id="hero">-->
    <!--        <h1>Horrortár</h1>-->
    <!--    </section>-->
    <!--</main>-->
    
    <section class="about">
        <div class="content">
            <img src="logo.jpeg">
            <div class="text">
                <h2>Rólunk</h2>
                <h5>Horrortár</h5>
                <p>Üdvözlünk a horrortar.hu-n, ahol a rettegés és a borzongás világába vezetjük el a horrorrajongókat! Oldalunk célja, hogy minden olyan személy számára izgalmas és hasznos tartalmat kínáljunk, aki szenvedélyesen követi a horror műfaját. Legyen szó klasszikusokról vagy az újabb, a műfajt tovább formáló alkotásokról – mi minden részletet feltárunk.

                    Itt megtalálhatók filmek, kritikák, elemzések, amelyek segítenek eligazodni a horrorfilmek rengetegében. A szívünk a feszült hangulatú thrillerektől a vérgőzös slasher-ekig mindent magába foglal, amire egy igazi rajongónak szüksége lehet. Fedezd fel velünk a legújabb megjelenéseket, a kultikus klasszikusokat és a rejtett gyöngyszemeket, miközben átélheted a filmek borzongató világát.

                </p>
            </div>
        </div>
    </section>

</body>


<?php
    mysqli_close($adb);
?>