<?php

session_start();

// konekcija
require_once "konekcija.php";
// funkcije za validaciju i filtriranje
require_once "funkcije.php";

// podaci sa klijentske strane
$email = filter_input(INPUT_POST, 'nEmail', FILTER_VALIDATE_EMAIL);
$pass = $conn->real_escape_string($_POST['nPass'] ?? "");

// kreiranje statementa za bazu
$stmt = $conn->prepare("SELECT * FROM `korisnici` WHERE `email`=? AND `sifra`=SHA1(?)");
$stmt->bind_param("ss", $email, $pass);

// izvrsavanje select upita
$prov = $stmt->execute();

if ($prov == false) {
    die("Greska:" . $conn->error);
}
$rez = $stmt->get_result();

if ($rez->num_rows > 0) {
    $red = $rez->fetch_assoc();
    //pamcenje info o logovanom korisniku
    $_SESSION['email'] = $red['email'];
    $_SESSION['ime'] = $red['ime'];
    $_SESSION['privilegija'] = $red['privilegija'];

    // pravila zbog privilegija
    switch ($red['privilegija']) {
        case 'Admin':
            header("Location:administriranjeUsera.php");
            break;
        case 'Moderator':
            header("Location:indexModerator.php");
            break;
        case 'Korisnik':
            header("Location:indexKorisnik.php");
            break;

        default:
        header ("Location: signup.html");
            break;
    }


    // if($red['privilegija']=="Admin"){
    //     header ("Location:index.php");
    // }else{
    //     header ("Location: 404.html");
    // }
} else {
    echo "Takav korisnik ne postoji! Proverite parametre!";
    header ("Location: 404.html");
}
