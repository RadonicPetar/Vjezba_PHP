<?php

/*
potrebno je unutar text boxa ili text area-e napisati neki string (rečenica)
te ispod njega staviti dva checkbox-a od kojih će jedan imati izbor spremi u session, a drugi spremi u cookie.
moguće je odabrati 1 ili oba izbora.
ukoliko se odabere opcija spremi u session, potrebno je string spremiti u session, te iz njega izračunati broj riječi u poslanom
stringu, i broj samoglasnika,
a ukoliko se odabere opcija spremi u cookie, potrebno je string spremiti u cookie sa trajanjem od 3 dana, te iz njega (cookiea)
izračunati duljinu stringa, te broj suglasnika.
ukoliko su odabrane obje opcije, potrebno je izračunati sve navedeno uz dodatak koliko ima znakova od znaka koji se nalazi na trećem
mjestu od početka stringa.
*/


session_start();

$poruka = "";
$tekst = $_POST['tekst'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($tekst)) {

    $session = isset($_POST['session']);
    $cookie  = isset($_POST['cookie']);

    $rezultat = "";

    if ($session) {
        $_SESSION['tekst'] = $tekst;

        $rijeci = 0;
        $bio_razmak = true;
        for ($i = 0; $i < strlen($tekst); $i++) {
            if ($tekst[$i] == ' ') {
                $bio_razmak = true;
            } else {
                if ($bio_razmak) {
                    $rijeci++;
                }
                $bio_razmak = false;
            }
        }

        $samoglasnici = 0;
        for ($i = 0; $i < strlen($tekst); $i++) {
            $z = strtolower($tekst[$i]);
            if ($z == 'a' || $z == 'e' || $z == 'i' || $z == 'o' || $z == 'u') {
                $samoglasnici++;
            }
        }

        $rezultat .= "<p><strong>SESSION:</strong><br>";
        $rezultat .= "Broj riječi: <b>" . $rijeci . "</b><br>";
        $rezultat .= "Broj samoglasnika: <b>" . $samoglasnici . "</b></p>";
    }

    if ($cookie) {
        setcookie("tekst", $tekst, time() + 3 * 24 * 60 * 60);

        $duljina = strlen($tekst);

        $suglasnici = 0;
        for ($i = 0; $i < strlen($tekst); $i++) {
            $z = strtolower($tekst[$i]);
            if ($z >= 'a' && $z <= 'z') {
                if ($z != 'a' && $z != 'e' && $z != 'i' && $z != 'o' && $z != 'u') {
                    $suglasnici++;
                }
            }
        }

        $rezultat .= "<p><strong>COOKIE:</strong><br>";
        $rezultat .= "Duljina stringa: <b>" . $duljina . "</b><br>";
        $rezultat .= "Broj suglasnika: <b>" . $suglasnici . "</b></p>";
    }

    if ($session && $cookie && strlen($tekst) >= 3) {
        $treci = $tekst[2];
        $brojTreceg = 0;
        for ($i = 0; $i < strlen($tekst); $i++) {
            if ($tekst[$i] === $treci) {
                $brojTreceg++;
            }
        }

        $rezultat .= "<p><strong>OBA ODABRANA:</strong><br>";
        $rezultat .= "Treći znak je '<b>" . $treci . "</b>' i pojavljuje se <b>" . $brojTreceg . "</b> puta.</p>";
    }

    $poruka = $rezultat;
}
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <title>VJEŽBA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        textarea {
            padding: 8px;
            width: 30%;
        }

        .poruka {
            margin-top: 20px;
            padding: 15px;
            background: #f0f0f0;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>

    <h1>UNOS</h1>

    <form method="POST">
        <label>Unesite string:</label>
        <textarea name="tekst" rows="6" required><?= $tekst ?></textarea>

        <label><input type="checkbox" name="session">Session</label>
        <label><input type="checkbox" name="cookie">Cookie</label>

        <br><br>
        <input type="submit" value="Spremi">
    </form>

    <?php if ($poruka): ?>
        <div class="poruka">
            <?= $poruka ?>
        </div>
    <?php endif; ?>

</body>

</html>