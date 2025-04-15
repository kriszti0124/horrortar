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
            background: url(background.jpg) center/cover no-repeat;
            /*background-size: cover;*/
            /*background-position: center;*/
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
            color: white;
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
            transition: scale 0.2s ease;
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
            /*color: #070A11;*/
            color: #fff;
            font-size: 18px;
            line-height: 28px;
            letter-spacing: 1px;
            margin-bottom: 45px;
        }

        /* Modal */
        #age-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        #age-modal .modal-content {
            background-color: rgba(0, 0, 0, 0.9);
            padding: 20px;
            border-radius: 10px;
        }

        #age-modal button {
            background-color: #444;
            color: white;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #age-modal button:hover {
            background-color: #666;
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
</head>

<body>
    <main>
        <!--<section id="hero">-->
        <!--    <h1>Horrortár</h1>-->
        <!--</section>-->
        
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

        <!-- Age Verification Modal -->
        <div id="age-modal">
            <div class="modal-content">
                <h2>Elmúltál már 16?</h2>
                
                <button onclick="ageConfirmed(true)">Igen</button>
                <button onclick="ageConfirmed(false)">Nem</button>
            </div>
        </div>
    </main>

<script>
    // Várunk, hogy betöltődjön az oldal, majd mutatjuk a modalt
    window.onload = function () {
        document.getElementById("age-modal").style.display = "flex";
    }

    // Funkció, amely megvizsgálja a választ
    function ageConfirmed(isOldEnough) {
        const modal = document.getElementById("age-modal");
        if (isOldEnough) {
            modal.style.display = "none"; // Bezárjuk a modalt
        } else {
                window.location.href = "https://www.google.com"; // Ha a válasz "Nem", visszairányítja a Google-re
            }
    }
</script>


</body>