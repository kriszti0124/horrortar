<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Kapcsolat</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: url(background.jpg) no-repeat center center/cover;
        }

        .kozepre {
            height: calc(100vh - 100px);
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper {
            position: relative;
            width: 600px;
            max-width: 90%;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            padding: 40px;
        }

        .wrapper h2 {
            font-size: 2em;
            color: rgb(12, 19, 25);
            text-align: center;
            margin-bottom: 20px;
        }

        .wrapper p, .wrapper ul {
            font-size: 1em;
            color: rgb(12, 19, 25);
            line-height: 1.6;
        }

        .wrapper ul {
            margin-top: 10px;
            padding-left: 20px;
        }

        .wrapper li {
            margin-bottom: 8px;
        }

        @media(max-width: 576px) {
            .wrapper {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="kozepre">
        <div class="wrapper">
            <h2>Kapcsolat</h2>
            <p>
                Van kérdésed, észrevételed, vagy technikai problémába ütköztél az oldalon? Esetleg ajánlanál egy hátborzongató filmet, amit mindenképp látni kellene az oldalon? Vedd fel velünk a kapcsolatot – nem harapunk!<br><br>
                <i class='bx bxs-envelope'></i> <strong>E-mail:</strong> info@horrortar.hu<br>
                <i class='bx bx-globe'></i> <strong>Weboldal:</strong> www.horrortar.hu<br><br>
                Írhatsz nekünk:
            </p>
            <ul>
                <li>ha hibát találtál az oldalon,</li>
                <li>ha egy film adatlapját szeretnéd kiegészíteni,</li>
                <li>ha problémád van a regisztrációval vagy bejelentkezéssel,</li>
                <li>vagy ha csak beszélgetnél egy jót a horrorfilmek világáról.</li>
            </ul>
            <p style="margin-top: 15px;">
                <strong>Figyelem!</strong> A sötétség szólít, de mi igyekszünk minden üzenetre 24 órán belül válaszolni.<br>
                Köszönjük, hogy a horrortar.hu közösségét erősíted!
            </p>
        </div>
    </div>
</body>
