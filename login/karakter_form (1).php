<?php
    session_start();
    include("kapcsolat.php");

    // Lekérdezzük a horrorkaraktereket az adatbázisból, beleértve a képeket is
    $result = mysqli_query($adb, "SELECT * FROM karakterek");

    // Kapcsolat lezárása
    mysqli_close($adb);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <title>Híres Horrorkarakterek</title>
    <style>
        body {
            background-image: linear-gradient(#2F3E45, #9CA4A6);
            margin: 0;
            padding: 0;
            overflow: auto;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .character-card {
            width: 200px;
            margin: 10px;
            background-color: rgb(12, 19, 25);
            color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 3);
            overflow: auto;
            cursor: pointer;
        }

        .character-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .character-card .name {
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        .character-card .release-date {
            text-align: center;
            font-size: 14px;
            color: #888;
            padding-bottom: 10px;
        }

        .character-details {
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

        .character-details-content {
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

        .character-details img {
            max-width: 100%;
            height: 500px;
            margin-bottom: 15px;
        }

        .character-details button {
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

        .character-details button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>

<div class="container" id="characters-container">
    <?php
     while ($row = mysqli_fetch_assoc($result)) {
         $characterName = $row['knev'];  // Karakter neve
         $characterImage = "uploads/" . $row['karakter_kep'];  // Karakter képe
         $characterDescription = $row['kleiras'];  // Karakter leírása
         
         // Display the character card
         echo "
            <div class='character-card' onclick='openCharacterDetails(\"$characterName\", \"$characterDescription\", \"$characterImage\")'>
                <img src='$characterImage' alt='$characterName'>
                <div class='name'>$characterName</div>
            </div>
         ";
     }
    ?>
</div>

<!-- Modal részletek -->
<div class="character-details" id="character-details">
    <div class="character-details-content">
        <h2 id="character-name"></h2>
        <p><strong>Leírás:</strong> <span id="character-description"></span></p>
        <img id="character-image" src="" alt="Character Image">
        <button onclick="closeDetails()">Bezárás</button>
    </div>
</div>

<script>
    // Open character details modal
    function openCharacterDetails(name, description, image) {
        document.getElementById("character-name").textContent = name;
        document.getElementById("character-description").textContent = description;
        document.getElementById("character-image").src = image;

        document.getElementById("character-details").style.display = "flex";  // Show modal
    }

    // Close character details modal
    function closeDetails() {
        document.getElementById("character-details").style.display = "none";  // Hide modal
    }
</script>

</body>
