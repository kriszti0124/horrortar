<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("kapcsolat.php");

if ($adb->connect_error) {
    die("Kapcsolódási hiba: " . $adb->connect_error);
}

$muvelet = $_REQUEST['muvelet'] ?? 'lista';
$azonosito = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_VALIDATE_INT) : null;
$szerkesztendo_login = null;
$login_lista = [];
$aktualis_oldal_url = '?p=admin';

if ($muvelet === 'torles' && $azonosito) {
    $utasitas = $adb->prepare("DELETE FROM login WHERE lid = ?");
    if ($utasitas) {
        $utasitas->bind_param('i', $azonosito);
        $utasitas->execute();
        $utasitas->close();
    }
}

if ($muvelet === 'mentes' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $lid = filter_input(INPUT_POST, 'lid', FILTER_VALIDATE_INT);
    $ldatum = filter_input(INPUT_POST, 'ldatum', FILTER_UNSAFE_RAW);
    $lip = filter_input(INPUT_POST, 'lip', FILTER_UNSAFE_RAW);
    $lsession = filter_input(INPUT_POST, 'lsession', FILTER_UNSAFE_RAW);
    $luid = filter_input(INPUT_POST, 'luid', FILTER_VALIDATE_INT);

    if ($lid && $ldatum && $lip && $lsession && $luid) {
        $utasitas = $adb->prepare("UPDATE login SET ldatum=?, lip=?, lsession=?, luid=? WHERE lid=?");
        if ($utasitas) {
            $utasitas->bind_param('sssii', $ldatum, $lip, $lsession, $luid, $lid);
            $utasitas->execute();
            $utasitas->close();
        }
    }
}

if ($muvelet === 'szerkesztes' && $azonosito) {
    $utasitas = $adb->prepare("SELECT * FROM login WHERE lid = ?");
    if ($utasitas) {
        $utasitas->bind_param('i', $azonosito);
        $utasitas->execute();
        $eredmeny = $utasitas->get_result();
        $szerkesztendo_login = $eredmeny->fetch_assoc();
        $utasitas->close();
        if (!$szerkesztendo_login) {
            $muvelet = 'lista';
        }
    } else {
        $muvelet = 'lista';
    }
}

if ($muvelet !== 'szerkesztes') {
    $muvelet = 'lista';
    $eredmeny = $adb->query("SELECT * FROM login ORDER BY lid ASC");
    if ($eredmeny) {
        while ($sor = $eredmeny->fetch_assoc()) {
            $login_lista[] = $sor;
        }
        $eredmeny->free();
    }
}

$adb->close();
?>

<body>
<div class="container">
    <div class="header">
        <h1><?= ($muvelet === 'szerkesztes') ? 'Bejelentkezés Módosítása' : 'Bejelentkezések'; ?></h1>
    </div>

    <?php if ($muvelet === 'szerkesztes' && $szerkesztendo_login): ?>
        <form action="<?= $aktualis_oldal_url ?>" method="POST">
            <input type="hidden" name="muvelet" value="mentes">
            <input type="hidden" name="lid" value="<?= htmlspecialchars($szerkesztendo_login['lid']) ?>">

            <label for="ldatum">Dátum:</label>
            <input type="text" name="ldatum" id="ldatum" value="<?= htmlspecialchars($szerkesztendo_login['ldatum']) ?>" required>

            <label for="lip">IP cím:</label>
            <input type="text" name="lip" id="lip" value="<?= htmlspecialchars($szerkesztendo_login['lip']) ?>" required>

            <label for="lsession">Session:</label>
            <input type="text" name="lsession" id="lsession" value="<?= htmlspecialchars($szerkesztendo_login['lsession']) ?>" required>

            <label for="luid">Felhasználó ID:</label>
            <input type="number" name="luid" id="luid" value="<?= htmlspecialchars($szerkesztendo_login['luid']) ?>" required>

            <button type="submit">Mentés</button>
        </form>
        <a href="<?= $aktualis_oldal_url ?>" class="back-link">Mégse</a>

    <?php elseif ($muvelet === 'lista'): ?>
        <main class="table">
            <section class="table-body">
                <table>
                    <thead>
                        <tr>
                            <th>Bejelentkezés ID</th>
                            <th>Bejelentkezés dátum</th>
                            <th>IP cím</th>
                            <th>Session</th>
                            <th>Felhasználó ID</th>
                            <th>Módosít</th>
                            <th>Töröl</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($login_lista)): ?>
                            <?php foreach ($login_lista as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['lid']) ?></td>
                                    <td><?= htmlspecialchars($row['ldatum']) ?></td>
                                    <td><?= htmlspecialchars($row['lip']) ?></td>
                                    <td><?= htmlspecialchars($row['lsession']) ?></td>
                                    <td><?= htmlspecialchars($row['luid']) ?></td>
                                    <td>
                                        <a href="<?= $aktualis_oldal_url ?>&muvelet=szerkesztes&id=<?= $row['lid'] ?>">
                                            <i class='bx bxs-pencil' style='color: green;'></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= $aktualis_oldal_url ?>&muvelet=torles&id=<?= $row['lid'] ?>"
                                           onclick="return confirm('Biztosan törölni szeretnéd a bejelentkezést?')">
                                            <i class='bx bxs-trash-alt' style='color: red;'></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="7">Nincs elérhető bejelentkezés.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </main>
    <?php endif; ?>
</div>
</body>