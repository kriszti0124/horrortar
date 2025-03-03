<?php
    session_start();
    include("kapcsolat.php");

    
    $result = mysqli_query($adb, "SELECT * FROM filmek");

    
    mysqli_close($adb);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Filmek</title>
    <style>
       body {
            background-image: linear-gradient(#2F3E45, #9CA4A6);
            margin: 0;
            padding: 0;
            overflow: auto;
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
        color: black;
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
        background-color: black;
        color: #fff;
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
        scale: 1.05;
        color: #fff;
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
        height: 280px;
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
        
        .wrapper {
            width: 90%;
        }
        
        .search {
            width: 200px;
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
            background-color:rgb(40, 39, 46);
            color:white;
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
            /* height: auto; */
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
</head>

<body>

<div class="container" id="movies-container">
    <?php
     while ($row = mysqli_fetch_assoc($result)) {
         $movieTitle = $row['fcim'];
         $movieDescription = $row['fleiras'];
         $moviePoster = $row['fposzter'];  
         $releaseDate = $row['fmegjelenes'];

         
         $posterPath = "uploads/" . $moviePoster; 

         
         echo "
            <div class='movie-card' onclick='openMovieDetails(\"$movieTitle\", \"$releaseDate\", \"$movieDescription\", \"$posterPath\")'>
                <img src='$posterPath' alt='$movieTitle'>
                <div class='title'>$movieTitle</div>
                
                <div class='release-date'>$releaseDate</div>
            </div>
         ";
     }
    ?>
</div>


<div class="movie-details" id="movie-details">
    <div class="movie-details-content">
        <h2 id="movie-title"></h2>
        <p><strong>Megjelenés dátuma:</strong> <span id="release-date"></span></p>
        <p><strong>Leírás:</strong> <span id="movie-description"></span></p>
        <img id="movie-image" src="" alt="Movie Image">
        <button onclick="closeDetails()">Bezárás</button>
    </div>
</div>

<script>
    
    function openMovieDetails(title, releaseDate, description, poster) {
        document.getElementById("movie-title").textContent = title;
        document.getElementById("release-date").textContent = releaseDate;
        document.getElementById("movie-description").textContent = description;
        document.getElementById("movie-image").src = poster;

        document.getElementById("movie-details").style.display = "flex";  // Show modal
    }

    
    function closeDetails() {
        document.getElementById("movie-details").style.display = "none";  
    }
</script>

</body>
