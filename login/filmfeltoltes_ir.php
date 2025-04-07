<?php
    session_start();
    include("kapcsolat.php");

    // Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
    if (!isset($_SESSION['uid'])) {
        header('Location: ?p=login'); 
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // Felhasználói bemenetek tisztítása
        $knev = mysqli_real_escape_string($adb, $_POST['knev']);
        $kleiras = mysqli_real_escape_string($adb, $_POST['kleiras']);
        
        // Kép feltöltés
        $karakter_kep = $_FILES['karakter_kep']['name'];
        $karakter_kep_tmp = $_FILES['karakter_kep']['tmp_name'];
        $upload_dir = 'uploads/'; 
        
        // Ellenőrizzük a fájl hibakódját
        if ($_FILES['karakter_kep']['error'] !== UPLOAD_ERR_OK) {
            echo "<script>alert('Hiba történt a fájl feltöltése során: " . $_FILES['karakter_kep']['error'] . "');</script>";
            exit();
        }
        
        // Fájlméret ellenőrzés (max 2MB)
        if ($_FILES['karakter_kep']['size'] > 2 * 1024 * 1024) { // 2MB
            echo "<script>alert('A fájl túl nagy! Max 2MB lehet.');</script>";
            exit();
        }
        
        // Egyedi fájlnév generálása az ütközések elkerülése érdekében
        $unique_filename = time() . "_" . basename($karakter_kep);
        $upload_path = $upload_dir . $unique_filename;

        // Fájl mozgatása a szerverre
        if (move_uploaded_file($karakter_kep_tmp, $upload_path)) {
            
            // SQL lekérdezés a karakter adatainak mentésére
            $query = "
                INSERT INTO karakterek (knev, kleiras, karakter_kep) 
                VALUES ('$knev', '$kleiras', '$unique_filename')
            ";

            // Lekérdezés végrehajtása
            if (mysqli_query($adb, $query)) {
                echo "<script>alert('Karakter sikeresen feltöltve!'); window.location.href = './?p=belsolap';</script>";
            } else {
                echo "<script>alert('Hiba történt a karakter feltöltése során: " . mysqli_error($adb) . "');</script>";
            }
        } else {
            echo "<script>alert('Hiba történt a karakter kép feltöltése során!');</script>";
        }
    }

    mysqli_close($adb);
?>
