<?php

//konekcija sa bazom podataka
require_once "konekcija.php";
require_once "funkcije.php";

// prikupljanje podataka sa klijentske strane i njihova obrada i validacija
$firstName = proveraPodataka(test_input($_POST['nFirstName']??""));
$lastName = proveraPodataka(test_input($_POST['nLastName']??""));
$email = filter_input(INPUT_POST,'nEmail',FILTER_VALIDATE_EMAIL);
$pass = proveraPass($conn->real_escape_string($_POST['nPass']??""));
$rePass = $conn->real_escape_string($_POST['nRePass']??"");

if($pass != $rePass){
    die("Lozinke se ne poklapaju!!!");
}


// upit za unos korisnika u tabelu
$stmt=$conn->prepare("INSERT INTO `korisnici` 
                        (`idKorisnika`, `ime`, `prezime`, `email`, `privilegija`, `sifra`) 
                    VALUES (NULL, ?, ?, ?, 'Korisnik', SHA1(?))");

$stmt->bind_param("ssss",$firstName,$lastName, $email, $pass);
$rez = $stmt->execute();
if($rez==false){
    die("Greska korisnik nije registrovan: ".$conn->error);
}
echo "Korisnik je uspesno registrovan!";