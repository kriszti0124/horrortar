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