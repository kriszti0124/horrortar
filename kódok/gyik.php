<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>GYIK</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            background: url(background.jpg) center/cover no-repeat;
            background-size: cover;
            background-position: center;
            overflow-x: hidden;
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
        
        .container {
            /*min-height: 100vh;*/
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 5%;
        }
        
        h1 {
            font-size: 2em;
            color: rgb(12, 19, 25);
            margin-bottom: 15px;
        }
        
        .gyik {
            width: 100%;
            max-width: 800px;
        }
        
        .kerdes {
            background: transparent;
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 255, 255, .5);
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 0, 0, .5);
            padding: 30px;
            font-size: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: all .3s ease-in-out;
        }
        
        .valasz {
            max-height: 0px;
            width: 100%;
            overflow: hidden;
            transition: all .3s ease-in-out;
        }
        
        .gyik i {
            transition: all .3s ease-in-out;
        }
        
        .gyik-list {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 10px
        }
        
        .gyik.active .valasz {
            max-height: 300px;
        }
        
        .gyik.active i {
            transform: rotate(45deg);
        }
        
        .valasz p {
            background: transparent;
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 255, 255, .5);
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 0, 0, .5);
            padding: 30px;
            font-size: 20px;
            
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
    <div class="container">
        <h1>Gyakran Ismételt Kérdések (GYIK)</h1>
        <div class="gyik-list">
            <div class="gyik">
                <div class="kerdes">
                    <p>Mi a horrortar.hu célja?</p>
                    <i class='bx bx-plus'></i>
                </div>
                <div class="valasz">
                    <p>A horrortar.hu azért jött létre, hogy egy helyen összegyűjtse mindazt, amit egy horrorrajongó kereshet: filmkritikákat, elemzéseket és érdekességeket a műfaj klasszikus és legújabb darabjairól. Ha szereted a borzongást, itt biztosan találsz magadnak valót!</p>
                </div>
            </div>
            <div class="gyik">
                <div class="kerdes">
                    <p>Miért érdemes regisztrálni?</p>
                    <i class='bx bx-plus'></i>
                </div>
                <div class="valasz">
                    <p>Regisztráció után hozzáférhetsz extra tartalmakhoz, például részletesebb kritikákhoz. Emellett kommentelhetsz, és részt vehetsz közösségi eseményeken is.</p>
                </div>
            </div>    
            <div class="gyik">
                <div class="kerdes">
                    <p>Hogyan írhatok kritikát vagy véleményt?</p>
                    <i class='bx bx-plus'></i>
                </div>
                <div class="valasz">
                    <p>Nagyon egyszerű: csak regisztrálj és jelentkezz be. A filmek alatti komment szekcióban megoszthatod a véleményed. Ha saját, hosszabb kritikád van, küldd el nekünk, és mi közzétesszük!</p>
                </div>
            </div>
            <div class="gyik">
                <div class="kerdes">
                    <p>Frissülnek az oldalon lévő tartalmak?</p>
                    <i class='bx bx-plus'></i>
                </div>
                <div class="valasz">
                    <p>Igen! Az oldalt folyamatosan frissítjük, hogy mindig a legújabb horrorfilmekről olvashass. Ha szeretnél elsőként értesülni, iratkozz fel a hírlevelünkre.</p>
                </div>
            </div>
            <div class="gyik">
                <div class="kerdes">
                    <p>Melyek a legnépszerűbb filmek, amikről írtok?</p>
                    <i class='bx bx-plus'></i>
                </div>
                <div class="valasz">
                    <p>A legkeresettebb filmek között mindig ott vannak a nagy klasszikusok, mint a Halloween, Psycho és The Shining, de a modern alkotásokról is olvashatsz, mint a Hereditary vagy a Get Out.</p>
                </div>
            </div>
            <div class="gyik">
                <div class="kerdes">
                    <p>Hogyan tudok kapcsolatba lépni a csapattal?</p>
                    <i class='bx bx-plus'></i>
                </div>
                <div class="valasz">
                    <p>Ha kérdésed vagy észrevételed van, vagy szeretnél velünk kapcsolatba lépni, látogass el a „Kapcsolat” menüpontra az oldalon. Ott megtalálod az e-mail címünket és az üzenetküldési lehetőséget is.</p>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    const gyiks = document.querySelectorAll(".gyik")
    
    gyiks.forEach((gyik) => {
        gyik.addEventListener("click", () => {
            if(gyik.classList.contains("active")) {
                gyik.classList.remove("active")
            }
            else {
                gyik.classList.add("active")
                gyiks.forEach((otherGyik) => {
                    if(otherGyik != gyik) {
                        otherGyik.classList.remove("active")
                    }
                })
            }
        })
    })
</script>