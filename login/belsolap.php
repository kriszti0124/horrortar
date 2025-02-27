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

    a:hover {
        color: black;
    }

    header{
        position: relative;
        padding: 0 2rem;
    }

    .navbar {
        width: 100%;
        height: 60px;
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .navbar .logo a {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .navbar .links {
        display: flex;
        gap: 2rem;
    }

    .navbar .toggle_btn {
        color: #fff;
        font-size: 1.5rem;
        cursor: pointer;
        display: none;
    }

    .action_btn {
        background-color: black;
        color: #fff;
        padding: 0.5rem 1rem;
        border: none;
        outline: none;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: bold;
        cursor: pointer;
        transition: scale 0.2 ease;
    }

    .action_btn:hover {
        scale: 1.05;
        color: #fff;
    }

    .action_btn:active {
        scale: 0.95;
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
        height: 180px;
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

    section#hero {
        height: calc(100vh - 60px);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
    }

    #hero h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
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
    }

    @media(max-width: 576px) {
        .dropdown_menu {
            left: 2rem;
            width: unset;
        }
    }
    
</style>

<body>

    <main>
        <section id="hero">
            <h1>Horrortár</h1>
        </section>
    </main>

</body>


<?php
    mysqli_close($adb);
?>
