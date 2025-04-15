<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("kapcsolat.php");
if ($adb->connect_error) {
    die("Sikertelen kapcsolódás: " . $adb->connect_error);
}

$muvelet = $_REQUEST['muvelet'] ?? 'lista';
$azonosito = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_VALIDATE_INT) : null;
$szerkesztendo_karakter = null;
$lista_adatok = [];
$aktualis_oldal_url = '?p=admin&modul=karakterek'; // <<< EZ ITT A FONTOS

if ($muvelet === 'torles' && $azonosito) {
    $utasitas = $adb->prepare("DELETE FROM karakterek WHERE kid = ?");
    if ($utasitas) {
        $utasitas->bind_param('i', $azonosito);
        $utasitas->execute();
        $utasitas->close();
    }
}

if ($muvelet === 'mentes' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $mentendo_azonosito = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nev = trim((string)filter_input(INPUT_POST, 'knev', FILTER_UNSAFE_RAW));
    $leiras = trim((string)filter_input(INPUT_POST, 'kleiras', FILTER_UNSAFE_RAW));
    $kep = trim((string)filter_input(INPUT_POST, 'karakter_kep', FILTER_UNSAFE_RAW));

    if ($mentendo_azonosito && !empty($nev)) {
        $utasitas = $adb->prepare("UPDATE karakterek SET knev = ?, kleiras = ?, karakter_kep = ? WHERE kid = ?");
        if ($utasitas) {
            $utasitas->bind_param('sssi', $nev, $leiras, $kep, $mentendo_azonosito);
            $utasitas->execute();
            $utasitas->close();
        }
    }
}

if ($muvelet === 'szerkesztes' && $azonosito) {
    $utasitas = $adb->prepare("SELECT kid, knev, kleiras, karakter_kep FROM karakterek WHERE kid = ?");
    if ($utasitas) {
        $utasitas->bind_param('i', $azonosito);
        $utasitas->execute();
        $eredmeny = $utasitas->get_result();
        $szerkesztendo_karakter = $eredmeny->fetch_assoc();
        $utasitas->close();
        if (!$szerkesztendo_karakter) {
            $muvelet = 'lista';
        }
    } else {
        $muvelet = 'lista';
    }
}

if ($muvelet !== 'szerkesztes') {
    $muvelet = 'lista';
    $eredmeny = $adb->query("SELECT * FROM karakterek ORDER BY kid ASC");
    if ($eredmeny) {
        while ($sor = $eredmeny->fetch_assoc()) {
            $lista_adatok[] = $sor;
        }
        $eredmeny->free();
    }
}

$adb->close();
?>
<head>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <div class="header">
        <h1><?= ($muvelet === 'szerkesztes') ? 'Karakter Módosítása' : 'Karakterek'; ?></h1>
    </div>

    <?php if ($muvelet === 'szerkesztes' && $szerkesztendo_karakter): ?>
        <form action="<?= $aktualis_oldal_url ?>" method="POST">
            <input type="hidden" name="muvelet" value="mentes">
            <input type="hidden" name="id" value="<?= htmlspecialchars($szerkesztendo_karakter['kid']) ?>">

            <label for="knev">Karakter név:</label>
            <input type="text" name="knev" id="knev" value="<?= htmlspecialchars($szerkesztendo_karakter['knev']) ?>" required>

            <label for="kleiras">Leírás:</label>
            <input type="text" name="kleiras" id="kleiras" value="<?= htmlspecialchars($szerkesztendo_karakter['kleiras']) ?>">

            <label for="karakter_kep">Kép elérési út:</label>
            <input type="text" name="karakter_kep" id="karakter_kep" value="<?= htmlspecialchars($szerkesztendo_karakter['karakter_kep']) ?>">

            <button type="submit">Mentés</button>
        </form>
        <a href="<?= $aktualis_oldal_url ?>" class="back-link">Mégse</a>

    <?php elseif ($muvelet === 'lista'): ?>
        <table>
            <thead>
                <tr>
                    <th>Karakter ID</th>
                    <th>Karakter név</th>
                    <th>Leírás</th>
                    <th>Kép</th>
                    <th>Módosít</th>
                    <th>Töröl</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($lista_adatok)): ?>
                    <?php foreach ($lista_adatok as $karakter): ?>
                        <tr>
                            <td><?= htmlspecialchars($karakter['kid']) ?></td>
                            <td><?= htmlspecialchars($karakter['knev']) ?></td>
                            <td><?= htmlspecialchars($karakter['kleiras']) ?></td>
                            <td><?= htmlspecialchars($karakter['karakter_kep']) ?></td>
                            <td>
                                <a href="<?= $aktualis_oldal_url ?>&muvelet=szerkesztes&id=<?= $karakter['kid'] ?>">
                                    <i class='bx bxs-pencil' style='color: green;'></i>
                                </a>
                            </td>
                            <td>
                                <a href="<?= $aktualis_oldal_url ?>&muvelet=torles&id=<?= $karakter['kid'] ?>"
                                   onclick="return confirm('Biztosan törölni szeretnéd: <?= addslashes($karakter['knev']) ?>?')">
                                    <i class='bx bxs-trash-alt' style='color: red;'></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">Nincs elérhető karakter.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>

