<?php
session_start();
include("kapcsolat.php");

// Filmek és feltöltők adatainak lekérdezése
$result = mysqli_query($adb, "
    SELECT 
        filmek.fcim,
        filmek.fleiras,
        filmek.fposzter,
        filmek.fmegjelenes,
        filmek.ffeltoltdatum,
        user.uid,
        user.unick,
        user.uprofkep_nev
    FROM filmek
    LEFT JOIN user ON filmek.uid = user.uid
");

mysqli_close($adb);
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta charset="UTF-8">
    <title>Filmek</title>
    <style>
        body {
            background-image: linear-gradient(#2F3E45, #9CA4A6);
            margin: 0;
            padding: 0;
            overflow: auto;
        }
        
li {
        list-style: none;
    }
    
    a {
        text-decoration: none;
        color: #fff;
        font-size: 1rem;
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
        height: 280px;
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

    section#hero {
        height: calc(100vh - 60px);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
    }

    #hero h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
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
        
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }
        
        .movie-card {
            width: 200px;
            margin: 10px;
            background-color: rgb(12, 19, 25);
            color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 3);
            overflow: auto;
            cursor: pointer;
        }
        
        .movie-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        
        .movie-card .title {
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }
        
        .movie-card .release-date {
            text-align: center;
            font-size: 14px;
            color: #888;
            padding-bottom: 10px;
        }
        
        .movie-details {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        
        .movie-details-content {
            background-color: rgb(40, 39, 46);
            color: white;
            padding: 20px;
            width: 80%;
            max-width: 700px;
            max-height: 95vh;
            overflow-y: auto;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        
        .movie-details img {
            max-width: 100%;
            height: 500px;
            margin-bottom: 15px;
        }
        
        .movie-details button {
            background-color: white;
            color: #000;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin-left: auto;
            margin-right: 0;
        }
        .movie-details button:hover {
            background-color: #555;
        }
        .user-info {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }
        .user-info img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="container" id="movies-container">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        $movieTitle = htmlspecialchars($row['fcim']);
        $movieDescription = htmlspecialchars($row['fleiras']);
        $moviePoster = "uploads/" . htmlspecialchars($row['fposzter']);
        $releaseDate = htmlspecialchars($row['fmegjelenes']);
        $postDate = htmlspecialchars($row['ffeltoltdatum']);

        $userId = $row['uid'];
        $userName = htmlspecialchars($row['unick']);
        $userProfilePicName = $row['uprofkep_nev'];

        // Profilkép elérési út beállítása
        if (!empty($userProfilePicName)) {
            $userProfilePic = "profilkepek/" . htmlspecialchars($userProfilePicName);
        } else {
            $userProfilePic = "alapprofilkep.jpg";
        }

        echo "
            <div class='movie-card' onclick='openMovieDetails(
                \"$movieTitle\",
                \"$releaseDate\",
                \"$movieDescription\",
                \"$moviePoster\",
                \"$userId\",
                \"$userName\",
                \"$userProfilePic\",
                \"$postDate\")'>
                <img src='$moviePoster' alt='$movieTitle'>
                <div class='title'>$movieTitle</div>
                <div class='release-date'>$releaseDate</div>
            </div>
        ";
    }
    ?>
</div>

<!-- Modal -->
<div class="movie-details" id="movie-details">
    <div class="movie-details-content">
        <div class="user-info">
            <img id="user-profile-pic" src="" alt="Profilkép">
            <span id="user-name"></span>
        </div>
        <p><strong>Feltöltés dátuma:</strong> <span id="post-date"></span></p>
        <h2 id="movie-title"></h2>
        <p><strong>Megjelenés dátuma:</strong> <span id="release-date"></span></p>
        <p><strong>Leírás:</strong> <span id="movie-description"></span></p>
        <img id="movie-image" src="" alt="Film kép">
        <button onclick="closeDetails()">Bezárás</button>
    </div>
</div>

<script>
    function openMovieDetails(title, releaseDate, description, poster, userId, userName, userProfilePic, postDate) {
        document.getElementById("movie-title").textContent = title;
        document.getElementById("release-date").textContent = releaseDate;
        document.getElementById("movie-description").textContent = description;
        document.getElementById("movie-image").src = poster;
        document.getElementById("user-name").textContent = userName;
        document.getElementById("user-profile-pic").src = userProfilePic;
        document.getElementById("post-date").textContent = postDate;

        document.getElementById("movie-details").style.display = "flex";
    }

    function closeDetails() {
        document.getElementById("movie-details").style.display = "none";
    }
</script>

</body>
