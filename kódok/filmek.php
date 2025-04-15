<?php
session_start();
include("kapcsolat.php");

// Filmek + feltöltők lekérdezése
$result = mysqli_query($adb, "
    SELECT 
        filmek.fid, 
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

$filmek = [];
while ($row = mysqli_fetch_assoc($result)) {
    $filmek[] = $row;
}
mysqli_close($adb);
?>

<head>
    <meta charset="UTF-8">
    <title>Filmek</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            justify-content: center;
            padding: 20px;
        }
        .movie-card {
            width: 200px;
            margin: 10px;
            background-color: rgb(12, 19, 25);
            color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 3);
            overflow: hidden;
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
            color: #ccc;
            padding-bottom: 10px;
        }
        .movie-details {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100vh;
            justify-content: center;
            align-items: center;
            background-color: rgba(0,0,0,0.7);
            z-index: 1000;
        }
        .movie-details-content {
            background-color: #28272e;
            color: white;
            padding: 20px;
            width: 90%;
            max-width: 700px;
            max-height: 95vh;
            overflow-y: auto;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            text-align: center;
        }
        .movie-details img {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }
        .movie-details button {
            background-color: white;
            color: #000;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            float: right;
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
        
        .dropdown_menu.open {
            height: 280px;
            box-shadow: 0 0 30px rgba(0, 0, 0, .5);
            z-index: 1000;
        }
    </style>
</head>
<body>

<div class="container">
<?php foreach ($filmek as $row): 
    $fid = $row['fid'];
    $movieTitle = htmlspecialchars($row['fcim']);
    $movieDescription = htmlspecialchars($row['fleiras']);
    $moviePoster = "uploads/" . htmlspecialchars($row['fposzter']);
    $releaseDate = htmlspecialchars($row['fmegjelenes']);
    $postDate = htmlspecialchars($row['ffeltoltdatum']);
    $userId = $row['uid'];
    $userName = htmlspecialchars($row['unick']);
    $userProfilePic = !empty($row['uprofkep_nev']) ? "profilkepek/" . $row['uprofkep_nev'] : "alapprofilkep.jpg";

    echo "
        <div class='movie-card' onclick='openMovieDetails(
            \"$movieTitle\",
            \"$releaseDate\",
            \"$movieDescription\",
            \"$moviePoster\",
            \"$userId\",
            \"$userName\",
            \"$userProfilePic\",
            \"$postDate\",
            \"$fid\")'>
            <img src='$moviePoster' alt='$movieTitle'>
            <div class='title'>$movieTitle</div>
            <div class='release-date'>$releaseDate</div>
        </div>
    ";
endforeach; ?>
</div>

<!-- Modal -->
<div class="movie-details" id="movie-modal">
    <div class="movie-details-content">
        <button onclick="closeModal()">Bezárás</button>
        <img id="modal-poster" src="" alt="Film poster">
        <h2 id="modal-title"></h2>
        <p id="modal-description"></p>
        <div class="user-info">
            <img id="modal-user-pic" src="" alt="User profile">
            <span id="modal-user-name"></span>
        </div>
        <div id="modal-date"></div>

        <!-- Értékelő űrlap -->
        <?php if (isset($_SESSION['uid'])): ?>
        <div class="wrapper">
            <h3>Mennyire értékeled a filmet?</h3>
            <form action="ertekeles_ir.php" method="POST">
                <input type="hidden" name="fid" id="form-fid">
                <input type="hidden" name="uid" value="<?= $_SESSION['uid'] ?>">
                <div class="rating">
                    <input type="number" name="eertekeles" hidden required>
                    <i class='bx bx-star star' style="--i:0;"></i>
                    <i class='bx bx-star star' style="--i:1;"></i>
                    <i class='bx bx-star star' style="--i:2;"></i>
                    <i class='bx bx-star star' style="--i:3;"></i>
                    <i class='bx bx-star star' style="--i:4;"></i>
                </div>
                <textarea name="ekomment" cols="30" rows="5" placeholder="Írd ide a rövid véleményed..." required></textarea>
                <div class="btn-group">
                    <button type="submit" class="btn submit">Visszajelzés küldése</button>
                    <button type="button" class="btn cancel" onclick="closeMovieDetails()">Visszavonás</button>
                </div>
            </form>
        </div>
        <?php else: ?>
            <p style="color:white;">Bejelentkezés után értékelhetsz!</p>
        <?php endif; ?>
    </div>
</div>

<script>
function openMovieDetails(title, release, desc, poster, uid, uname, upic, postDate, fid) {
    document.getElementById("movie-modal").style.display = "flex";
    document.getElementById("modal-title").innerText = title;
    document.getElementById("modal-description").innerText = desc;
    document.getElementById("modal-poster").src = poster;
    document.getElementById("modal-user-name").innerText = uname;
    document.getElementById("modal-user-pic").src = upic;
    document.getElementById("modal-date").innerText = "Feltöltve: " + postDate;
    document.getElementById("form-fid").value = fid;
}
function closeModal() {
    document.getElementById("movie-modal").style.display = "none";
}
</script>
<script>
const allStar = document.querySelectorAll('.rating .star');
const ratingValue = document.querySelector('.rating input');

allStar.forEach((item, idx) => {
    item.addEventListener('click', function () {
        ratingValue.value = idx + 1;
        allStar.forEach((i, iIdx) => {
            i.classList.remove('active');
            i.classList.replace('bxs-star', 'bx-star');
            if (iIdx <= idx) {
                i.classList.add('active');
                i.classList.replace('bx-star', 'bxs-star');
            }
        });
        console.log('Beállított értékelés:', ratingValue.value);
    });
});
</script>

</body>
