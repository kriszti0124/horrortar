<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("kapcsolat.php");

// Kapcsolódás ellenőrzése
if ($adb->connect_error) {
    die("Kapcsolódási hiba: " . $adb->connect_error);
}

$muvelet = $_REQUEST['muvelet'] ?? 'lista';
$azonosito = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_VALIDATE_INT) : null;
$szerkesztendo_ertekeles = null;
$lista_adatok = [];
$aktualis_oldal_url = '?p=admin';

if ($muvelet === 'torles' && $azonosito) {
    $utasitas = $adb->prepare("DELETE FROM ertekeles WHERE eid = ?");
    if ($utasitas) {
        $utasitas->bind_param('i', $azonosito);
        $utasitas->execute();
        $utasitas->close();
    }
}

if ($muvelet === 'mentes' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $mentendo_azonosito = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $fid = filter_input(INPUT_POST, 'fid', FILTER_VALIDATE_INT);
    $uid = filter_input(INPUT_POST, 'uid', FILTER_VALIDATE_INT);
    $ertekeles = filter_input(INPUT_POST, 'eertekeles', FILTER_VALIDATE_INT);
    $komment = filter_input(INPUT_POST, 'ekomment', FILTER_UNSAFE_RAW);
    $datum = date('Y-m-d H:i:s'); // Friss dátum

    if ($mentendo_azonosito && $fid && $uid && !empty($ertekeles)) {
        $utasitas = $adb->prepare("UPDATE ertekeles SET fid = ?, uid = ?, eertekeles = ?, ekomment = ?, eertekelesdatum = ? WHERE eid = ?");
        if ($utasitas) {
            $utasitas->bind_param('iisssi', $fid, $uid, $ertekeles, $komment, $datum, $mentendo_azonosito);
            $utasitas->execute();
            $utasitas->close();
        }
    }
}

if ($muvelet === 'szerkesztes' && $azonosito) {
    $utasitas = $adb->prepare("SELECT eid, fid, uid, eertekeles, ekomment, eertekelesdatum FROM ertekeles WHERE eid = ?");
    if ($utasitas) {
        $utasitas->bind_param('i', $azonosito);
        $utasitas->execute();
        $eredmeny = $utasitas->get_result();
        $szerkesztendo_ertekeles = $eredmeny->fetch_assoc();
        $utasitas->close();
        if (!$szerkesztendo_ertekeles) {
            $muvelet = 'lista';
        }
    } else {
        $muvelet = 'lista';
    }
}

if ($muvelet !== 'szerkesztes') {
    $muvelet = 'lista';
    $eredmeny = $adb->query("SELECT * FROM ertekeles ORDER BY eid ASC");
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
        <h1><?= ($muvelet === 'szerkesztes') ? 'Értékelés Módosítása' : 'Értékelések'; ?></h1>
    </div>

    <?php if ($muvelet === 'szerkesztes' && $szerkesztendo_ertekeles): ?>
        <form action="<?= $aktualis_oldal_url ?>" method="POST">
            <input type="hidden" name="muvelet" value="mentes">
            <input type="hidden" name="id" value="<?= htmlspecialchars($szerkesztendo_ertekeles['eid']) ?>">

            <label for="fid">Film ID:</label>
            <input type="text" name="fid" id="fid" value="<?= htmlspecialchars($szerkesztendo_ertekeles['fid']) ?>" required>

            <label for="uid">Felhasználó ID:</label>
            <input type="text" name="uid" id="uid" value="<?= htmlspecialchars($szerkesztendo_ertekeles['uid']) ?>" required>

            <label for="eertekeles">Értékelés:</label>
            <input type="text" name="eertekeles" id="eertekeles" value="<?= htmlspecialchars($szerkesztendo_ertekeles['eertekeles']) ?>" required>

            <label for="ekomment">Komment:</label>
            <input type="text" name="ekomment" id="ekomment" value="<?= htmlspecialchars($szerkesztendo_ertekeles['ekomment']) ?>">

            <button type="submit">Mentés</button>
        </form>
        <a href="<?= $aktualis_oldal_url ?>" class="back-link">Mégse</a>

    <?php elseif ($muvelet === 'lista'): ?>
        <table>
            <thead>
                <tr>
                    <th>Értékelés ID</th>
                    <th>Film ID</th>
                    <th>Felhasználó ID</th>
                    <th>Értékelés</th>
                    <th>Komment</th>
                    <th>Dátum</th>
                    <th>Módosít</th>
                    <th>Töröl</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($lista_adatok)): ?>
                    <?php foreach ($lista_adatok as $ertekeles): ?>
                        <tr>
                            <td><?= htmlspecialchars($ertekeles['eid']) ?></td>
                            <td><?= htmlspecialchars($ertekeles['fid']) ?></td>
                            <td><?= htmlspecialchars($ertekeles['uid']) ?></td>
                            <td><?= htmlspecialchars($ertekeles['eertekeles']) ?></td>
                            <td><?= htmlspecialchars($ertekeles['ekomment']) ?></td>
                            <td><?= htmlspecialchars($ertekeles['eertekelesdatum']) ?></td>
                            <td>
                                <a href="<?= $aktualis_oldal_url ?>&muvelet=szerkesztes&id=<?= $ertekeles['eid'] ?>">
                                    <i class='bx bxs-pencil' style='color: green;'></i>
                                </a>
                            </td>
                            <td>
                                <a href="<?= $aktualis_oldal_url ?>&muvelet=torles&id=<?= $ertekeles['eid'] ?>"
                                   onclick="return confirm('Biztosan törölni szeretnéd az értékelést?')">
                                    <i class='bx bxs-trash-alt' style='color: red;'></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8">Nincs elérhető értékelés.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>