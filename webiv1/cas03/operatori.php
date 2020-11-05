<?php
// $a = 1;
// $b = 1;
// echo ++$b;
// echo "<hr>";
//ref op
// $a = 2;
// $b = &$a;
// echo "a = $a b = $b";
// echo "<hr>";
// $a = 7;
// echo "a = $a b = $b";
// echo "<hr>";

$a = true;
$b = false;
$c = $a || $b;
$d = $a && $b;
$f = (!$a && $b) || ($a && !$b);
echo "a = $a <br/>";
echo "b = $b <br/>";
echo "c = $c <br/>";
echo "d = $d <br/>";
echo "f = $f <br/>";
echo "c ";
var_dump($c);
echo "<br/>";
echo "d ";
var_dump($d);
echo "<br/>";
echo "f ";
var_dump($f);
echo "<br/>";
echo "<hr>";

//operatori prodjenjea
$a = "0";
$b = 1;
if($a===$b){
    echo "Tacno";
}else{
    echo "Netacno";
}
echo "<hr>";
$color = "blue";
echo $color = $color ?? "red";