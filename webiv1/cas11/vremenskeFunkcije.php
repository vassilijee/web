<?php

# VREMENSKE FUNKCIJE

// date()

$datum = date("d/m/Y H:i:s", 1604568342); // drugi parametar je neko vreme u sekundama od 1.1.1970
var_dump($datum);

$vremeS = time();
echo "<br>";
var_dump($vremeS);

//mktime()

$vremeMK = mktime(8, 02, 22, 13, 10, 1994);
echo "<br>";
var_dump($vremeMK);

$datum2 = date("d/m/Y H:i:s", $vremeMK); // drugi parametar je neko vreme u sekundama od 1.1.1970
echo "<br>";
var_dump($datum2);
