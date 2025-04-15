<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("kapcsolat.php");

if ($adb->connect_error) {
    die("Kapcsolódási hiba: " . $adb->connect_error);
}

$muvelet = $_REQUEST['muvelet'] ?? 'lista';
$azonosito = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_VALIDATE_INT) : null;
$szerkesztendo_user = null;
$lista_adatok = [];
$aktualis_oldal_url = '?p=admin';

if ($muvelet === 'torles' && $azonosito) {
    $utasitas = $adb->prepare("DELETE FROM user WHERE uid = ?");
    if ($utasitas) {
        $utasitas->bind_param('i', $azonosito);
        $utasitas->execute();
        $utasitas->close();
    }
}

if ($muvelet === 'mentes' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = filter_input(INPUT_POST, 'uid', FILTER_VALIDATE_INT);
    $umail = filter_input(INPUT_POST, 'umail', FILTER_VALIDATE_EMAIL);
    $unick = filter_input(INPUT_POST, 'unick', FILTER_UNSAFE_RAW);
    $upw = filter_input(INPUT_POST, 'upw', FILTER_UNSAFE_RAW);
    $uszuldatum = filter_input(INPUT_POST, 'uszuldatum', FILTER_UNSAFE_RAW);
    $uprofkep_nev = filter_input(INPUT_POST, 'uprofkep_nev', FILTER_UNSAFE_RAW);
    $udatum = date('Y-m-d H:i:s');

    if ($uid && $umail && $unick && $upw) {
        $utasitas = $adb->prepare("UPDATE user SET umail=?, unick=?, upw=?, uszuldatum=?, udatum=?, uprofkep_nev=? WHERE uid=?");
        if ($utasitas) {
            $utasitas->bind_param('ssssssi', $umail, $unick, $upw, $uszuldatum, $udatum, $uprofkep_nev, $uid);
            $utasitas->execute();
            $utasitas->close();
        }
    }
}

if ($muvelet === 'szerkesztes' && $azonosito) {
    $utasitas = $adb->prepare("SELECT * FROM user WHERE uid = ?");
    if ($utasitas) {
        $utasitas->bind_param('i', $azonosito);
        $utasitas->execute();
        $eredmeny = $utasitas->get_result();
        $szerkesztendo_user = $eredmeny->fetch_assoc();
        $utasitas->close();
        if (!$szerkesztendo_user) {
            $muvelet = 'lista';
        }
    } else {
        $muvelet = 'lista';
    }
}

if ($muvelet !== 'szerkesztes') {
    $muvelet = 'lista';
    $eredmeny = $adb->query("SELECT * FROM user ORDER BY uid ASC");
    if ($eredmeny) {
        while ($sor = $eredmeny->fetch_assoc()) {
            $lista_adatok[] = $sor;
        }
        $eredmeny->free();
    }
}

$adb->close();
?>

<body>
<div class="container">
    <div class="header">
        <h1><?= ($muvelet === 'szerkesztes') ? 'Felhasználó Módosítása' : 'Felhasználók'; ?></h1>
    </div>

    <?php if ($muvelet === 'szerkesztes' && $szerkesztendo_user): ?>
        <form action="<?= $aktualis_oldal_url ?>" method="POST">
            <input type="hidden" name="muvelet" value="mentes">
            <input type="hidden" name="uid" value="<?= htmlspecialchars($szerkesztendo_user['uid']) ?>">

            <label for="umail">Email:</label>
            <input type="email" name="umail" id="umail" value="<?= htmlspecialchars($szerkesztendo_user['umail']) ?>" required>

            <label for="unick">Felhasználónév:</label>
            <input type="text" name="unick" id="unick" value="<?= htmlspecialchars($szerkesztendo_user['unick']) ?>" required>

            <label for="upw">Jelszó (hash vagy sima):</label>
            <input type="text" name="upw" id="upw" value="<?= htmlspecialchars($szerkesztendo_user['upw']) ?>" required>

            <label for="uszuldatum">Születési dátum:</label>
            <input type="text" name="uszuldatum" id="uszuldatum" value="<?= htmlspecialchars($szerkesztendo_user['uszuldatum']) ?>">

            <label for="uprofkep_nev">Profilkép fájlnév:</label>
            <input type="text" name="uprofkep_nev" id="uprofkep_nev" value="<?= htmlspecialchars($szerkesztendo_user['uprofkep_nev']) ?>">

            <button type="submit">Mentés</button>
        </form>
        <a href="<?= $aktualis_oldal_url ?>" class="back-link">Mégse</a>

    <?php elseif ($muvelet === 'lista'): ?>
        <main class="table">
            <section class="table-body">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Felhasználónév</th>
                            <th>Jelszó (hash)</th>
                            <th>Születési dátum</th>
                            <th>Regisztráció dátuma</th>
                            <th>Profilkép</th>
                            <th>Módosít</th>
                            <th>Töröl</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($lista_adatok)): ?>
                            <?php foreach ($lista_adatok as $user): ?>
                                <tr>
                                    <td><?= htmlspecialchars($user['uid']) ?></td>
                                    <td><?= htmlspecialchars($user['umail']) ?></td>
                                    <td><?= htmlspecialchars($user['unick']) ?></td>
                                    <td><?= htmlspecialchars($user['upw']) ?></td>
                                    <td><?= htmlspecialchars($user['uszuldatum']) ?></td>
                                    <td><?= htmlspecialchars($user['udatum']) ?></td>
                                    <td><?= htmlspecialchars($user['uprofkep_nev']) ?></td>
                                    <td><a href="<?= $aktualis_oldal_url ?>&muvelet=szerkesztes&id=<?= $user['uid'] ?>"><i class='bx bxs-pencil' style='color: green;'></i></a></td>
                                    <td><a href="<?= $aktualis_oldal_url ?>&muvelet=torles&id=<?= $user['uid'] ?>" onclick="return confirm('Biztosan törölni szeretnéd ezt a felhasználót?')"><i class='bx bxs-trash-alt' style='color: red;'></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="9">Nincs felhasználó a rendszerben.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </main>
    <?php endif; ?>
</div>
</body>
