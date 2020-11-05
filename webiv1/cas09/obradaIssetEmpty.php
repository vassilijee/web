<?php

// isset
$varijabla = "";

var_dump($varijabla);

if (isset($varijabla)) {
    echo "Varijabla je setovana: $varijabla";
} else {
    echo "Varijabla nije setovana: $varijabla";
}

echo "<hr>";

// empty

$varijabla2 = "0"; // 0, "" => prazan

if (empty($varijabla2)) {
    echo 'Varijabla je prazna';
} else {
    echo 'Varijabla nije prazna';
}
