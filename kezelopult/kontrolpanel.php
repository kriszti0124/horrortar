<?php
    include("kapcsolat.php");
    // Admin jogosultság ellenőrzése
    if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
        echo "<script> alert('Nincs jogosultságod az admin felülethez!'); </script>";
        header('Location: ./'); // Visszairányítás a főoldalra
        exit;
    }
?>

<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <style>
        body{
            background-color: blue;
            background-image: linear-gradient(#2F3E45, #9CA4A6);
            margin: 0;
            padding: 0;
            overflow: auto;
        }

        .container {
            width: 95%;
            max-width: 1600px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            padding: 40px;
            margin: 20px auto;
        }

        .header h1 {
            text-align: center;
            color: rgb(12, 19, 25);
            margin-bottom: 30px;
        }
    
        table {
            width: 100%;
            border-collapse: collapse;
            color: rgb(12, 19, 25);
        }
    
        thead {
            background-color: rgba(255, 255, 255, 0.2);
        }
    
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
    
        .tablesdiv {
            margin-top: 30px;
            margin-bottom: 5px;
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
        }

    </style>
</head>

<body>
    <div class="tablesdiv">
        <?php
        include("ertekeles.php");
        ?>
    </div>
    <div class="tablesdiv">
        <?php
        include("films.php");
        ?>
    </div>
    <div class="tablesdiv">
        <?php
        include("characters.php");
        ?>
    </div>
    <div class="tablesdiv">
        <?php
        include("login.php");
        ?>
    </div>
    
    </div>
    <div class="tablesdiv">
        <?php
        include("user.php");
        ?>
    </div>
</body>
