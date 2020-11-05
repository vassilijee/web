<?php

//opseg vazenja promenljive
// lokalni

$a = 1; //globalni

// echo $a;

function nekaFunkcija()
{
    global $a;
    $a = "string";
    echo "<br>" . $a;
}

echo "<br>" . $a;
nekaFunkcija();
echo "<br>" . $a;

//GLOBALS
echo "<hr>";

$b = 2;

function funkcijaNeka()
{
    echo $GLOBALS['b'];
    $GLOBALS['rez'] = $GLOBALS['b'] ** 3; //2^3
}
echo "<br>";
funkcijaneka();
echo "<br>";
echo $GLOBALS['rez'];

// staticki scoupe
echo "<hr><br>";
function brojacPoseta()
{
    static $i = 1;
    echo $i . "<br>";;
    $i++;
}

brojacPoseta();
brojacPoseta();
brojacPoseta();
brojacPoseta();
