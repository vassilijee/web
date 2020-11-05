<?php

date('H');
$a = 20;
$b = 10;
function ispisi($a, &$b)
{
    $b = 100;
    $c = $a * $b;

    echo "neki tekst c=" . $c;
}

// ispisi(1.51, 5);
echo "<br>";
ispisi($a, $b);
echo "<br>b = $b";

// opcini parametar

function izracunajCenuSaPorezom($cena, $porez = 20)
{
    $cenaSaPorezom = $cena * ($porez / 100) + $cena;
    echo "<br>" . $cenaSaPorezom;
}
izracunajCenuSaPorezom(2000);
