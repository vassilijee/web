<?php

declare(strict_types=1);

function saberiDvaBroja(int $a, int $b): string
{
    // int $c = 1;
    $c = $a + $b;
    // return (string) $c;
    return (string) "rez: " . $c;
}

echo saberiDvaBroja(10, 20);


// rekurzivna funkcija

function faktorijel(int $n)
{
    // uslov za napustanje rekurzije
    if ($n == 0) {
        return 1;
    }

    return $n * faktorijel($n - 1);
}

echo "<br>" . faktorijel(180);
