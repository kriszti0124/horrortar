<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Bejelentkezés</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: url(background.jpg) no-repeat;
        background-size: cover;
        background-position: center;
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }
    
    main {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    
    h1 {
        font-size: 3rem;
        margin-bottom: 0.5rem;
        text-align: center;
    }
    
    h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        text-align: center;
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
        
        .wrapper {
            width: 90%;
        }
    }
</style>

<body>
    <main>
        <div class="wrapper">
            <h1>404</h1>
            <h2>Neked holnap már nem fütyül a rigó</h2>
        </div>
    </main>
</body>