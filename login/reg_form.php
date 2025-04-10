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
    <title>Regisztráció</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: url(background.jpg) no-repeat;
            background-size: cover;
            background-position: center;
        }
        
        .kozepre {
            height: calc(100vh - 100px); 
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
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
            height: 220px;
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

        .wrapper {
            position: relative;
            width: 400px;
            height: 540px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .5);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 30px rgba(0, 0, 0, .5);
            overflow: hidden;
        }

        .wrapper .form-box {
            width: 100%;
            padding: 40px;
        }

        .form-box h2 {
            font-size: 2em;
            color: rgb(12, 19, 25);
            text-align: center;
        }

        .input-box {
            position: relative;
            width: 100%;
            height: 50px;
            border-bottom: 2px solid rgb(12, 19, 25);
            margin: 30px 0;
        }

        .input-box label {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            font-size: 1em;
            color: rgb(12, 19, 25);
            font-weight: 500;
            pointer-events: none;
            transition: .5s;
        }

        .input-box input:focus~label,
        .input-box input:valid~label {
            top: -5px;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1em;
            color: rgb(12, 19, 25);
            font-weight: 600;
            padding: 0 35px 0 5px;
        }

        .input-box .icon {
            position: absolute;
            right: 8px;
            font-size: 1.2em;
            color: rgb(12, 19, 25);
            line-height: 57px;
        }

        .btn {
            width: 100%;
            height: 45px;
            background: rgb(12, 19, 25);
            border: none;
            outline: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            color: #fff;
            font-weight: 500; 
        }

        .login-register {
            font-size: .9em;
            color: rgb(12, 19, 25);
            text-align: center;
            font-weight: 500;
            margin: 25px 0 10px;
        }

        .login-register p a {
            color: rgb(12, 19, 25);
            text-decoration: none;
            font-weight: 600;
        }

        .login-register p a:hover {
            text-decoration: underline;

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
        
            .wrapper {
                width: 90%;
            }
        }
    </style>

</head>
<body>
<div class="kozepre">
    <div class="wrapper">
        <div class="form-box register">
            <h2>Regisztráció</h2>
            <form action="reg_ir.php" method="POST" target="kisablak">
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-envelope'></i></span>
                    <input type="email" id="email" name="umail">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-user-circle'></i></span>
                    <input type="text" id="becenev" name="unick">
                    <label>Felhasználónév</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                    <input type="password"  id="jelszo" name="upw" maxlength="8" minlength="4">
                    <label>Jelszó</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-calendar'></i></span>
                    <input type="date" id="szuldatum" name="uszuldatum">
                    <label>Születési dátum</label>
                </div>
                <button type="submit" class="btn">Regisztráció</button>
                <div class="login-register">
                    <p>Van már fiókod?<a href="./?p=login" class="register-link"> Bejelentkezés</a></p>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
    if (!isset($_SESSION['uid'])) {
        // print "<input type='button' value='Belépés' id='btnlogin' onclick='location.href=\"./?p=login\"'>";
    }
    else
    { 
        $user = mysqli_fetch_array(mysqli_query($adb , 
                "SELECT * FROM user 
                WHERE uid='$_SESSION[uid]'"));
                if($user['uprofkep_nev']!="") $profilkep = "./profilkep/$user[uprofkep_nev]";
                else                          $profilkep = "alapprofilkep.jpg";

                print "
                    <img src='./profilkepek/$user[uprofkep_nev]' style='height:36px;
                            border-radius:50%;'>
                    <a id='nev' href='./?p=adatlapom'>$_SESSION[unick]</a>
                    <input type='button' value='Kilépés' id='btnkilep' onclick='kisablak.location.href=\"./logout.php\"'>
                ";
    }
        
?>
</body>

<?php
    mysqli_close($adb);
?>
