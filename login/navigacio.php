<style>
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
        color: black;
    }

    header{
        position: relative;
        padding: 0 2rem;
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
        height: 125px;
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
</style>

<header>
        <div class="navbar">
            <div class="logo"><a href="https://horrortar.hu/">Logo</a></div>
            <ul class="links">
                <li><a href="kezdolap">Kezdőlap</a></li>
                <li><a href="filmek">Filmek</a></li>
                <li><a href="karakterek">Karakterek</a></li>
            </ul>
            <div class="search">
                <input type="text" placeholder="Keresés">
                <i class='bx bx-search'></i>
            </div>

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
                    echo "<a href='./?p=login' class='action_btn'>Belépés</a>";
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
