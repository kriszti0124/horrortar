<?php
session_start();
include('kapcsolat.php');

// Ellenőrizd, hogy POST metódussal érkezett-e a kérés
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // A form értékeinek megfelelő módosítás
    $fid = mysqli_real_escape_string($adb, $_POST['fid']);
    $uid = mysqli_real_escape_string($adb, $_POST['uid']);
    $rating = mysqli_real_escape_string($adb, $_POST['eertekeles']); // eertekeles a helyes mezőnév
    $comment = mysqli_real_escape_string($adb, $_POST['ekomment']); // ekomment a helyes mezőnév

    // Ellenőrizd, hogy az értékelés és komment nem üres
    if (empty($rating) || empty($comment)) {
        echo "<script> alert('Kérjük, adjon meg egy értékelést és kommentet!') </script>";
        print "<script> parent.location.href = './' </script>";
        exit;
    }

    // Ellenőrizd, hogy a felhasználó már értékelte-e ezt a filmet
    $e_query = mysqli_query($adb, "SELECT * FROM ertekeles WHERE fid = '$fid' AND uid = '$uid'");
    if (mysqli_num_rows($e_query) > 0) {
        echo "<script> alert('Már értékelted ezt a filmet!') </script>";
        print "<script> parent.location.href = './' </script>";
        exit;
    }

    // Mentés
    $insert_query = "
        INSERT INTO ertekeles (fid, uid, eertekeles, ekomment, eertekelesdatum)
        VALUES ('$fid', '$uid', '$rating', '$comment', NOW());
    ";

    // Ellenőrizd, hogy sikerült-e beszúrni az értékelést
    if (mysqli_query($adb, $insert_query)) {
        echo "<script> alert('Köszönjük értékelésed!') </script>";
    } else {
        echo "<script> alert('Hiba történt az értékelés mentése során!') </script>";
    }

    // Visszairányítás az oldalra
    print "<script> parent.location.href = './' </script>";
} else {
    echo "<script> alert('Nem megfelelő kérés!') </script>";
}
?>
