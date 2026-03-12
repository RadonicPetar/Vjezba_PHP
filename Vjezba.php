<?php

$recenica = readline("Unesite jednu rečenicu: ");

$ukupnoZnakova = strlen($recenica);

$brojRijeci = 0;
$prethodniJeRazmak = true;

for ($i = 0; $i < strlen($recenica); $i++) {
    $znak = $recenica[$i];
    if (($znak >= 'a' && $znak <= 'z') || ($znak >= 'A' && $znak <= 'Z') || ($znak >= '0' && $znak <= '9')) {
        if ($prethodniJeRazmak) {
            $brojRijeci++;
        }
        $prethodniJeRazmak = false;
    } else {
        $prethodniJeRazmak = true;
    }
}

$samoglasnici = 0;
$suglasnici = 0;
$brojSlovaE = 0;

for ($i = 0; $i < strlen($recenica); $i++) {
    $znak = strtolower($recenica[$i]);  // samo ovdje koristimo strtolower za e/E

    if ($znak == 'a' || $znak == 'e' || $znak == 'i' || $znak == 'o' || $znak == 'u') {
        $samoglasnici++;
        if ($znak == 'e') {
            $brojSlovaE++;
        }
    } elseif (($znak >= 'a' && $znak <= 'z')) {
        $suglasnici++;
    }
}

echo "\nRezultati:\n";
echo "1. Ukupan broj znakova: $ukupnoZnakova\n";
echo "2. Ukupan broj riječi: $brojRijeci\n";
echo "3. Broj samoglasnika: $samoglasnici\n";
echo "4. Broj suglasnika: $suglasnici\n";
echo "5. Slovo 'e' (ili 'E') pojavljuje se: $brojSlovaE puta\n";
echo "\nTrenutni datum i vrijeme: " . date("d.m.Y. H:i:s") . "\n";