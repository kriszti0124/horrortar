<style>
    /* Stílusok változatlanok maradnak */
    .navbar {
        width: 100%;
        height: 60px;
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .navbar .logo img {
        height: 50px;
        width: 50px;
        border-radius: 50%;
        box-shadow: 0 0 30px rgba(0, 0, 0, .5);
    }

    .navbar .links {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .navbar .toggle_btn {
        color: #fff;
        font-size: 1.5rem;
        cursor: pointer;
        display: none;
    }

    .search {
        position: relative;
        width: 300;
        height: 40px;
    }

    .search input {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        color: #ffffff;
        background: transparent;
        border: 1 solid rgba(255, 255, 255, 0.5);
        outline: none;
        border-radius: 4px;
        padding: 0 10px 0 45px !important;
        backdrop-filter: blur(10px);
    }

    .search input::placeholder {
        color: #fff;
    }

    .search i {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 10px;
        padding-right: 10px;
        color: #fff;
        border-right: 1px solid #fff;
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
        color: #e74c3c;
        transition: color 0.3s;
    }

    header{
        position: relative;
        padding: 0 2rem;
    }

    .user-info {
        display: flex;
        align-items: center;
        margin-right: 10px;
    }

    .user-info img {
        margin-right: 10px;
    }

    .action_btn {
        background-color: #fff;
        color: black;
        padding: 0.5rem 1rem;
        margin-left: 10px;
        border: none;
        outline: none;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: bold;
        cursor: pointer;
        transition: scale 0.2 ease;
    }

    .action_btn:hover {
        color: #e74c3c;
    }

    .action_btn:active {
        scale: 0.95;
    }

    .dropdown_menu {
        display: block;
        position: absolute;
        right: 2rem;
        top: 60px;
        height: 0;
        width: 300px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border-radius: 10px;
        overflow: hidden;
        transition: height .2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 0 30px rgba(0, 0, 0, .5);
    }

    .dropdown_menu.open {
        height: 450px;
        border: 2px solid rgba(255, 255, 255, .5);
        box-shadow: 0 0 30px rgba(0, 0, 0, .5);
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

        .search {
            width: 200px;
        }
    }
</style>

<header>
    <div class="navbar">
        <div class="logo"><a href="https://horrortar.hu/"><img src="logo.jpeg"></a></div>
        <ul class="links">
            <li><a href="?p=filmek">Filmek</a></li>
            <li><a href="?p=karakterek">Karakterek</a></li>
            <li><a href="?p=karakterfeltolt">Karakter feltöltés</a></li>
            <li><a href="?p=feltoltes">Film feltöltés</a></li>

            <?php
            // Ha a felhasználó admin, akkor megjelenik a kezelőpult gomb
            if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
                echo '<li><a href="?p=admin" class="admin-button">Kezelőpult</a></li>';
            }

            if (isset($_SESSION['uid'])) {
                $user = mysqli_fetch_array(mysqli_query($adb , "SELECT * FROM user WHERE uid='$_SESSION[uid]'"));
                
                if($user['uprofkep_nev'] != "") $profilkep = "./profilkepek/$user[uprofkep_nev]";
                else $profilkep = "alapprofilkep.jpg";

                echo "
                    <div class='user-info'>
                        <img src='$profilkep' style='height:36px; width: 36px; border-radius:50%;'>
                        <a href='./?p=adatlapom' id='nev' style='color:white;'>$_SESSION[unick]</a>
                    </div>
                    <a href='./logout.php' class='action_btn' style='background-color:rgb(12, 19, 25); color:white; border-radius:6px;'>Kilépés</a>
                ";
            } else {
                echo "<a href='./?p=login' class='action_btn' style='background-color:rgb(12, 19, 25); color:white; border-radius:6px;'>Belépés</a>";
            }
            ?>
        </ul>

        <div class="toggle_btn">
            <i class="bx bx-menu"></i>
        </div>
    </div>

    <div class="dropdown_menu">
        <li><a href="?p=filmek">Filmek</a></li>
        <li><a href="?p=karakterek">Karakterek</a></li>
        <li><a href="?p=karakterfeltolt">Karakter feltöltés</a></li>
        <li><a href="?p=feltoltes">Film feltöltés</a></li>
        
        <?php
        if (isset($_SESSION['uid'])) {
            echo "
                <li><img src='$profilkep' style='height:36px; width: 36px; border-radius:50%;'>
                <a href='./?p=adatlapom' id='nev' style='color:white; padding-left:10px;'>$_SESSION[unick]</a></li>
                <li><a href='./logout.php' class='action_btn' style='background-color:rgb(12, 19, 25); color:white; border-radius:6px;'>Kilépés</a></li>";
        } else {
            echo "<li><a href='./?p=login' class='action_btn' style='background-color:rgb(12, 19, 25); color:white; border-radius:6px;'>Belépés</a></li>";
        }
        ?>
    </div>
</header>

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
