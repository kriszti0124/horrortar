<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lilita One">
    <title>Horrortár</title>
</head>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background: linear-gradient(to top, ); 
        /* rgb(13, 28, 26), rgb(44, 105, 97) */
        margin: 0;
        padding: 20px;
        background-repeat: no-repeat;
    }

    h2 {
        font-family:"Lilita One";
        font-size: 50px;
        text-align: center;
        color: white; 
    }

    .navbar {
        background-color: black;
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 10px 0;
        box-shadow: 0 4px 2px -2px #333;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .navbar a {
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }

    .navbar a:hover {
        color: rgb(135, 178, 169);
    }

    .navbar-logo {
        font-size: 1.5em;
        color: rgb(135, 178, 169);
        /* font-family: you murderer */
    }
</style>

<body>
    <nav class="navbar">
        <div class="navbar-logo">Horrortár</div>
        <a href="kezdolap">Kezdőlap</a>
        <a href="filmek">Filmek</a>
        <a href="karakterek">Karakterek</a>
        <a href="bejelentkezes">Bejelentkezés</a>
    </nav>

    <h2>Horrortár</h2>
</body>
</html>