<?php
    session_start();
    include("kapcsolat.php");

    $ip = $_SERVER['REMOTE_ADDR'];
    $sess = substr(session_id(), 0, 8);

    if( isset($_SESSION['uid'])) $uid = $_SESSION['uid'];
    else                         $uid = 0;

    $url = $_SERVER['REQUEST_URI'];

    mysqli_query($adb , "
        INSERT INTO naplo (nid, ndatum, nip, nsession, nuid, nurl) 
        VALUES (NULL, NOW(), '$ip', '$sess', '$uid', '$url')
    ");
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Horrortár</title>
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
            .navbar .links, .navbar .action_btn 
            { 
                display: none; 
            } 
            .navbar .toggle_btn 
            { 
                display: block; 
            } 
            .dropdown_menu 
            { 
                display: block; 
            } 
        }
        @media(max-width: 576px) { 
            .dropdown_menu 
            { 
                left: 2rem; width: unset; 
            } 
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo"><a href="#">Logo</a></div>
            <ul class="links">
                <li><a href="kezdolap">Kezdőlap</a></li>
                <li><a href="filmek">Filmek</a></li>
                <li><a href="karakterek">Karakterek</a></li>
            </ul>

            <?php
                if (isset($_SESSION['uid'])) {
                    $user = mysqli_fetch_array(mysqli_query($adb , "SELECT * FROM user WHERE uid='$_SESSION[uid]'"));
                    if($user['uprofkep_nev'] != "") $profilkep = "./profilkepek/$user[uprofkep_nev]";
                    else $profilkep = "alapprofilkep.jpg";

                    echo "
                        <div class='links'>
                            <img src='$profilkep' style='height:36px; border-radius:50%;'>
                            <a href='./?p=adatlapom' id='nev' style='color:white;'>$_SESSION[unick]</a>
                            <a href='./logout.php' class='action_btn'>Kilépés</a>
                        </div>
                    ";
                } else {
                    echo "<a href='login_form2.php' class='action_btn'>Belépés</a>";
                }
            ?>

            <div class="toggle_btn">
                <i class="bx bx-menu"></i>
            </div>
        </div>

        <div class="dropdown_menu">
            <li><a href="kezdolap">Kezdőlap</a></li>
            <li><a href="filmek">Filmek</a></li>
            <li><a href="karakterek">Karakterek</a></li>
            <?php
                if (isset($_SESSION['uid'])) {
                    echo "<li><a href='./logout.php' class='action_btn'>Kilépés</a></li>";
                }
            ?>
        </div>
    </header>

    <main>
        <section id="hero">
            <h1>Horrortár</h1>
        </section>
    </main>

    <script>
        const toggleBtn = document.querySelector('.toggle_btn')
        const toggleBtnIcon = document.querySelector('.toggle_btn i')
        const dropdownMenu = document.querySelector('.dropdown_menu')

        toggleBtn.onclick = function () {
            dropdownMenu.classList.toggle('open')
            const isOpen = dropdownMenu.classList.contains('open')

            toggleBtnIcon.classList = isOpen ? 'bx bx-x' : 'bx bx-menu'
        }
    </script>

        <?php
            if(isset($_GET['p'])) $p = $_GET['p'];
            else                  $p = "";
            if (!isset($_SESSION['uid']))
            {
                if($p=="")                  include("kezdolap.php");      else
                if ($p=="regisztracio")     include ("reg_form2.php");    else
                if ($p=="login")            include ("login_form2.php");  else
                                            include("404_kulso.php");
            }
            else
            {
                if ($p=="")                 include ("belsolap2.php");    else
                if ($p=="adatlapom")        include("adatlap_form.php");  else
                                            include("404_belso.php");
            }
        ?>
</body>
</html>

<?php
    mysqli_close($adb);
?>
