<?php
session_start();
// Hibák megjelenítése
ini_set('display_errors', 1); 
error_reporting(E_ALL);

// Kezdjük el a kimenet bufferelését
ob_start();

include("kapcsolat.php");

// Ha nincs bejelentkezve a felhasználó, irányítsuk át a login oldalra
if (!isset($_SESSION['uid'])) {
    header('Location: ?p=login');
    exit();
}

// Ha POST kérést kapunk
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // A karakter adatai
    $knev = mysqli_real_escape_string($adb, $_POST['knev']);
    $kleiras = mysqli_real_escape_string($adb, $_POST['kleiras']);
    
    // A karakter képe
    $karakter_kep = $_FILES['karakter_kep']['name'];
    $karakter_kep_tmp = $_FILES['karakter_kep']['tmp_name'];
    $upload_dir = 'uploads/';  // A fájlok feltöltésének könyvtára
    
    // Egyedi fájlnév generálása
    $unique_filename = time() . "_" . basename($karakter_kep);
    $upload_path = $upload_dir . $unique_filename;

    // Ha sikerül feltölteni a képet
    if (move_uploaded_file($karakter_kep_tmp, $upload_path)) {
        
        $uid = $_SESSION['uid']; // A bejelentkezett felhasználó ID-ja

        // Adatbázisba való mentés
        $query = "
            INSERT INTO karakterek (fid, knev, kleiras, karakter_kep) 
            VALUES ('$uid', '$knev', '$kleiras', '$unique_filename')
        ";

        // Ha sikeres az adatbázisba való beszúrás
        if (mysqli_query($adb, $query)) {
            echo "<script>alert('Karakter sikeresen feltöltve!');</script>";
            header('Location: index.php');  // Irányítsa vissza a főoldalra
            exit();
        } else {
            // Hibák naplózása
            echo "<script>alert('Hiba történt a karakter feltöltése során: " . mysqli_error($adb) . "');</script>";
        }
    } else {
        echo "<script>alert('Hiba történt a karakter kép feltöltése során!');</script>";
    }
}

// Kapcsolat bezárása
mysqli_close($adb);

// Kimenet vége, buffert kiürítjük
ob_end_flush();
?>
