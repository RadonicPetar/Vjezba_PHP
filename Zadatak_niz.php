<?php

/*
potrebno je omogućiti unos broja gradova sa iznosima prosječnih plaća za svaki grad.
nakon što završi unos, potrebno je izračunati ukupan iznos svih plaća za gradove
koji počinju sa slovom B.
Zatim je potrebno gradove čija je prosječna plaća manja od prosjeka plaća svih unesenih gradova
izdvojiti u novi indeksirani niz pod nazivom $socijalnigradovi.
Nakon toga, potrebno je svim gradovima čija prosječna plaća je ispod 2000 povećati istu za 30% te natrag
spremiti vrijednost.
Zadatak staviti na git i poslati link ili invitation.
*/

$brojGradova = (int)(readline("Koliko gradova želite unijeti? "));

if ($brojGradova <= 0) {
    echo "Broj gradova mora biti veći od 0.\n";
    exit;
}

$gradovi = [];

for ($i = 1; $i <= $brojGradova; $i++) {
    $grad = readline("Unesite ime grada $i: ");

    $placa = (float)(readline("Unesite prosječnu plaću za $grad: "));

    $gradovi[$grad] = $placa;
}

$ukupnoB = 0;
foreach ($gradovi as $grad => $placa) {
    if (strtoupper($grad[0]) === 'B') {
        $ukupnoB += $placa;
    }
}
echo "\nUkupan iznos plaća za gradove na slovo B: " .$ukupnoB. "\n";

$zbrojSvih = 0;
foreach ($gradovi as $placa) {
    $zbrojSvih += $placa;
}
$prosjekSvih = $zbrojSvih / count($gradovi);

$socijalnigradovi = [];
foreach ($gradovi as $grad => $placa) {
    if ($placa < $prosjekSvih) {
        $socijalnigradovi[] = $grad;
    }
}

echo "\nGradovi s plaćom ispod prosjeka (" .$prosjekSvih. "): ";
echo implode(", ", $socijalnigradovi) . "\n";

echo "\nPlaće uvećane za 30% ako su bile ispod 2000:\n";
foreach ($gradovi as $grad => &$placa) { 
    if ($placa < 2000) {
        $placa *= 1.3;
        echo "$grad: " .$placa. "\n";
    }
}