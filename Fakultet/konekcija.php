<?php

/* ================= Konekcija sa bazom podataka ============================ */
$host = "127.0.0.1:3306";
$user = "root";
$pass = "";
$db = "fakultet";

$conn = new mysqli($host, $user, $pass, $db);

// echo "<pre>";
// var_dump($conn);
// echo "</pre>";

if ($conn->connect_error) {
    die("Greska:" . $conn->connect_error);
}

echo "Konekcija sa serverom db je uspesna!";
/* ================= END Konekcija sa bazom podataka ============================ */