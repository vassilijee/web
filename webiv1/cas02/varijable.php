<?php
// varijable

/* vise
linija */

#vaaaaaaaaaaaaaaaaaaaaar

$varijabla = "string ";

$broj = 3;

$str = $varijabla ."imamo neki broj = $broj";
$bool = false;
echo $str;
echo "<hr>";
echo $broj;
echo "<hr>";
var_dump($bool) ;
echo "<hr>";
//nizovi
//      0 1 2 3 indeks
$niz = [2,4,6,7,2,2,2,2,2,2];
echo $niz[sizeof($niz)-1];//count
echo "<hr>";
$multiniz = [
    [1,2,3],
    [4,5],
    [6,0]
];
echo $multiniz[2][1];  
echo "<hr>";
$uspeh = [
    "web" => ["test" =>[5,5], "usmeno" => 4,"kontrolni" => 5],
    "prg" => 4,
    "eng" => 1
];

//pristuppppppppppppp
echo $uspeh['web']["test"][0];
echo "<hr>";

echo "<hr>";
echo "<hr>";
echo "<hr>";
echo "<hr>";

//var_dump($varijabla);