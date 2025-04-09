<?php
include("kapcsolat.php");

if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    $query = "SELECT unick, uprofkep_nev FROM users WHERE uid = $uid";
    $result = mysqli_query($adb, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'User not found']);
    }

    mysqli_close($adb);
} else {
    echo json_encode(['error' => 'No user ID provided']);
}
?>
