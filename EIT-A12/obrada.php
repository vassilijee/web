<?php
session_start();

require_once "konekcija.php";

$indeks = $_POST['nIndeks'] ?? "";
$ime = $_POST['nIme'] ?? "";
$email = $_POST['nEmail'] ?? "";
$komentar = $_POST['nKomentar'] ?? "";

if (isset($_POST['nDodajKomentar'])) {
    if (
        empty($ime) || empty($email) || empty($komentar)    ) {
        //echo "Svi podaci moraju biti uneti";
        die("Niste uneli sve podatke!!!");
    }

   // Validate email
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Email adresa nije validna");
   }


    //    $query = "INSERT INTO `student` (`broj_indeksa`, `prezime`, `ime`, `status`, `sifra`, `slika`) 
    //    VALUES ('$brIndeksa', '$prezime', '$ime', '$status', '$sifra', '')";

    $query = sprintf(
        "INSERT INTO `utisak` (`Ime`, `Email`, `Komentar`, `Datum`) 
    VALUES ('%s', '%s', '%s', now())",
        $conn->real_escape_string($ime),
        $conn->real_escape_string($email),
        $conn->real_escape_string($komentar),
    );

    echo $query;

    $rez = $conn->query($query);
    if ($rez == false) {
        echo "Upit nije izvrsen:" . $conn->error;
    } else {
        echo "<script>alert(Podaci su uspesno uneti u tabelu!!!);</script>";
    }
}