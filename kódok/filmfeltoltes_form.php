<?php
    session_start();
    include("kapcsolat.php");

    // Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
    if (!isset($_SESSION['uid'])) {
        header('Location: ?p=login'); // Ha nincs bejelentkezve, irányítsuk a login oldalra
        exit();
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Film feltöltés</title>
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
            height: calc(100vh - 40px); 
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .wrapper {
            position: relative;
            width: 400px;
            height: 580px;
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
        
        .dropdown_menu.open {
            height: 280px;
            box-shadow: 0 0 30px rgba(0, 0, 0, .5);
            z-index: 1000;
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
            <div class="form-box">
                <h2>Tölts fel filmeket</h2>
                <form action="filmfeltoltes_ir.php" method="POST" enctype="multipart/form-data">
                    <div class="input-box">
                        <input type="text" id="fcim" name="fcim" required>
                        <label>Cím</label>
                    </div>
                    <div class="input-box">
                        <input type="date" id="fmegjelenes" name="fmegjelenes" required>
                        <label>Megjelenés dátuma</label>
                    </div>
                    <div class="input-box">
                        <input type="text" id="fmufaj" name="fmufaj" required>
                        <label>Műfaj</label>
                    </div>
                    <div class="input-box">
                        <textarea id="fleiras" name="fleiras" required></textarea>
                        <label>Leírás</label>
                    </div>
                    <div class="input-box">
                        <input type="file" id="fposzter" name="fposzter" accept="image/*" required>
                        <label>Film posztere</label>
                    </div>
                    <button type="submit" class="btn">Feltöltés</button>
                </form>
            </div>
        </div>
    </div>
</body>
