<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("kapcsolat.php");

if ($adb->connect_error) {
    die("Kapcsolódási hiba: " . $adb->connect_error);
}

$muvelet = $_REQUEST['muvelet'] ?? 'lista';
$azonosito = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_VALIDATE_INT) : null;
$szerkesztendo_film = null;
$lista_adatok = [];
$aktualis_oldal_url = '?p=admin';

if ($muvelet === 'torles' && $azonosito) {
    $utasitas = $adb->prepare("DELETE FROM filmek WHERE fid = ?");
    if ($utasitas) {
        $utasitas->bind_param('i', $azonosito);
        $utasitas->execute();
        $utasitas->close();
    }
}

if ($muvelet === 'mentes' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $fid = filter_input(INPUT_POST, 'fid', FILTER_VALIDATE_INT);
    $fcim = filter_input(INPUT_POST, 'fcim', FILTER_UNSAFE_RAW);
    $fmegjelenes = filter_input(INPUT_POST, 'fmegjelenes', FILTER_UNSAFE_RAW);
    $fleiras = filter_input(INPUT_POST, 'fleiras', FILTER_UNSAFE_RAW);
    $fposzter = filter_input(INPUT_POST, 'fposzter', FILTER_UNSAFE_RAW);
    $uid = filter_input(INPUT_POST, 'uid', FILTER_VALIDATE_INT);
    $datum = date('Y-m-d H:i:s');

    if ($fid && $fcim && $fmegjelenes && $fleiras && $uid) {
        $utasitas = $adb->prepare("UPDATE filmek SET fcim=?, fmegjelenes=?, fleiras=?, fposzter=?, ffeltoltdatum=?, uid=? WHERE fid=?");
        if ($utasitas) {
            $utasitas->bind_param('ssssssi', $fcim, $fmegjelenes, $fleiras, $fposzter, $datum, $uid, $fid);
            $utasitas->execute();
            $utasitas->close();
        }
    }
}

if ($muvelet === 'szerkesztes' && $azonosito) {
    $utasitas = $adb->prepare("SELECT * FROM filmek WHERE fid = ?");
    if ($utasitas) {
        $utasitas->bind_param('i', $azonosito);
        $utasitas->execute();
        $eredmeny = $utasitas->get_result();
        $szerkesztendo_film = $eredmeny->fetch_assoc();
        $utasitas->close();
        if (!$szerkesztendo_film) {
            $muvelet = 'lista';
        }
    } else {
        $muvelet = 'lista';
    }
}

if ($muvelet !== 'szerkesztes') {
    $muvelet = 'lista';
    $eredmeny = $adb->query("SELECT * FROM filmek ORDER BY fid ASC");
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
        <h1><?= ($muvelet === 'szerkesztes') ? 'Film Módosítása' : 'Filmek'; ?></h1>
    </div>

    <?php if ($muvelet === 'szerkesztes' && $szerkesztendo_film): ?>
        <form action="<?= $aktualis_oldal_url ?>" method="POST">
            <input type="hidden" name="muvelet" value="mentes">
            <input type="hidden" name="fid" value="<?= htmlspecialchars($szerkesztendo_film['fid']) ?>">

            <label for="fcim">Film cím:</label>
            <input type="text" name="fcim" id="fcim" value="<?= htmlspecialchars($szerkesztendo_film['fcim']) ?>" required>

            <label for="fmegjelenes">Megjelenés:</label>
            <!-- Módosított sor -->
            <input type="text" name="fmegjelenes" id="fmegjelenes" value="<?= htmlspecialchars($szerkesztendo_film['fmegjelenes'] ?? '') ?>" required>

            <label for="fleiras">Leírás:</label>
            <input type="text" name="fleiras" id="fleiras" value="<?= htmlspecialchars($szerkesztendo_film['fleiras']) ?>" required>

            <label for="fposzter">Poszter URL:</label>
            <input type="text" name="fposzter" id="fposzter" value="<?= htmlspecialchars($szerkesztendo_film['fposzter']) ?>">

            <label for="uid">Felhasználó ID:</label>
            <input type="text" name="uid" id="uid" value="<?= htmlspecialchars($szerkesztendo_film['uid']) ?>" required>

            <button type="submit">Mentés</button>
        </form>
        <a href="<?= $aktualis_oldal_url ?>" class="back-link">Mégse</a>

    <?php elseif ($muvelet === 'lista'): ?>
        <main class="table">
            <section class="table-body">
                <table>
                    <thead>
                        <tr>
                            <th>Film ID</th>
                            <th>Film cím</th>
                            <th>Megjelenés</th>
                            <th>Leírás</th>
                            <th>Feltöltés dátuma</th>
                            <th>Poszter</th>
                            <th>Felhasználó ID</th>
                            <th>Módosít</th>
                            <th>Töröl</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($lista_adatok)): ?>
                            <?php foreach ($lista_adatok as $film): ?>
                                <tr>
                                    <td><?= htmlspecialchars($film['fid']) ?></td>
                                    <td><?= htmlspecialchars($film['fcim']) ?></td>
                                    <td><?= htmlspecialchars($film['fmegjelenes']) ?></td>
                                    <td><?= htmlspecialchars($film['fleiras']) ?></td>
                                    <td><?= htmlspecialchars($film['ffeltoltdatum']) ?></td>
                                    <td><?= htmlspecialchars($film['fposzter']) ?></td>
                                    <td><?= htmlspecialchars($film['uid']) ?></td>
                                    <td>
                                        <a href="<?= $aktualis_oldal_url ?>&muvelet=szerkesztes&id=<?= $film['fid'] ?>">
                                            <i class='bx bxs-pencil' style='color: green;'></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= $aktualis_oldal_url ?>&muvelet=torles&id=<?= $film['fid'] ?>"
                                           onclick="return confirm('Biztosan törölni szeretnéd a filmet?')">
                                            <i class='bx bxs-trash-alt' style='color: red;'></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="9">Nincs elérhető film.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </main>
    <?php endif; ?>
</div>
</body>
