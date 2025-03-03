<?php
    session_start();
    include("kapcsolat.php");

    
    if (!isset($_SESSION['uid'])) {
        header('Location: ?p=login'); 
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $fcim = mysqli_real_escape_string($adb, $_POST['fcim']);
        $fmegjelenes = mysqli_real_escape_string($adb, $_POST['fmegjelenes']);
        $fmufaj = mysqli_real_escape_string($adb, $_POST['fmufaj']);
        $fleiras = mysqli_real_escape_string($adb, $_POST['fleiras']);
        
        
        $fposzter = $_FILES['fposzter']['name'];
        $fposzter_tmp = $_FILES['fposzter']['tmp_name'];
        $upload_dir = 'uploads/'; 
        
        
        $unique_filename = time() . "_" . basename($fposzter);
        $upload_path = $upload_dir . $unique_filename;

        
        if (move_uploaded_file($fposzter_tmp, $upload_path)) {
            
            $uid = $_SESSION['uid']; 

            
            $query = "
                INSERT INTO filmek (fcim, fmegjelenes, fmufaj, fleiras, fposzter, ffeltoltdatum, uid) 
                VALUES ('$fcim', '$fmegjelenes', '$fmufaj', '$fleiras', '$unique_filename', NOW(), '$uid')
            ";

            
            if (mysqli_query($adb, $query)) {
                echo "<script>alert('Film sikeresen feltöltve!'); window.location.href = './?p=belsolap';</script>";
            } else {
                echo "<script>alert('Hiba történt a film feltöltése során: " . mysqli_error($adb) . "');</script>";
            }
        } else {
            echo "<script>alert('Hiba történt a poszter feltöltése során!');</script>";
        }
    }

    mysqli_close($adb);
?>
