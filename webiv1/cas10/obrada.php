<?php
echo "<hr>";

# UCITAVANJE SPOLJASNIH DATOTEKAs

include "header.php";

//$ime = $_REQUEST['nIme']??"anonimus";
// PROVERA tipa zahteva 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ime = $_REQUEST['nIme'] ?? "anonimus";
    // filter za sanaciju imena od specijalnih html tagova
    $ime = filter_var($ime, FILTER_SANITIZE_STRING);

    ///////////////////////////////// // kreirati funkciju za proveru da li ime poseduje numericke karaktere
    // function proveraIme($ime)
    // {
    //     preg_match("/[0-9]/", $ime);
    // }
    // if (porveraIme($ime)) {
    //     die("Ime ne sme pocinjati brojem / ne sme imati numericke karaktere");
    // }
    /////////////////////////////////////////////////////////////
    $email = filter_input(INPUT_POST, 'nEmail', FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Neispravna email adresa!!!");
    }


    $pol = $_REQUEST['nPol'] ?? "";
    $hrana = $_REQUEST['nHrana'] ?? [];
    $placanje = $_REQUEST['nPlacanje'] ?? "kes";
} else {
    //echo $ime;
    die("Pogresan zahtev!");
}

var_dump($hrana);

echo "<br><br>";

echo "Korisnik: " . $ime;
echo "<br>Email: " . $email;
echo "<br>Pol: " . $pol;

echo "<ul>";
foreach ($hrana as $value) {
    echo "<li>" . $value;
}
echo "</ul>";

echo "<br><b>Nacin placanja:</b>$placanje";

// filteri za filtriranje imena i ostalih podataka 
// ukljuciti i email.


include "footer.php";
