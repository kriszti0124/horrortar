<?php
    session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Adatlap</title>
</head>
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
            min-height: calc(100vh - 100px); 
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
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

        .wrapper {
            position: relative;
            width: 400px;
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

    <?php
        $user = mysqli_fetch_array(mysqli_query($adb , "SELECT * FROM user 
                                                        WHERE uid='$_SESSION[uid]'"));
    ?>
<div class="kozepre">
    <div class="wrapper">
        <div class="form-box register">
            <h2>Adatlap</h2>
            <form action='adatlap_ir.php' method='post' target='kisablak' class='reglog' enctype='multipart/form-data' id='adatlap'>
            <input type='hidden' name='uid' value='<?=$user['uid']?>'>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-envelope'></i></span>
                    <input type="email" id="email" name="umail" value="<?=$user['umail']?>">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-user-circle'></i></span>
                    <input type="text" id="becenev" name="unick" value="<?=$user['unick']?>">
                    <label>Felhasználónév</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-calendar'></i></span>
                    <input type="date" id="szuldatum" name="uszuldatum" value="<?=$user['uszuldatum']?>">
                    <label>Születési dátum</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-skull'></i></span>
                    <input type="file" id="profkep" name="profkep">
                    <label>Új profilkép</label>
                </div>
                <button type="submit" class="btn">Adatok módosítása</button>
            </form>
            <br>

            <!--<h2>Jelszómódosítás</h2>-->
            <!--<form action='adatlap_ir.php' method='post' target='kisablak' class='reglog' enctype='multipart/form-data' id='jelszomodositas'>-->
            <!--<div class="input-box">-->
            <!--    <span class="icon"><i class='bx bxs-lock-alt'></i></span>-->
            <!--    <input type='password' name='upw' maxlength='8' minlength='4'>-->
            <!--    <label>Új jelszó</label>-->
            <!--</div>-->
            <!--<div class="input-box">-->
            <!--    <span class="icon"><i class='bx bxs-lock-alt'></i></span>-->
            <!--    <input type='password' name='upw' maxlength='8' minlength='4'>-->
            <!--    <label>Új jelszó megint</label>-->
            <!--</div>-->
            <!--<div class="input-box">-->
            <!--    <span class="icon"><i class='bx bxs-lock-alt'></i></span>-->
            <!--    <input type='password' name='upw' maxlength='8' minlength='4'>-->
            <!--    <label>Jelenlegi jelszó</label>-->
            <!--</div>-->
        </div>
    </div>
</div>

    
<?php
    mysqli_close($adb);
?>