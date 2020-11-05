<?php
$korisnik = ['user' => 'admin', 'pass' => 'admin123'];
// nUserName se odnosi na polje sa forme cije je name atribut imao ovu vrednost
$userName = $_POST['nUserName'] ?? "Nepoznati korisnik";
$pass = $_POST['nPassword'];

if ($userName === $korisnik['user'] && $pass === $korisnik['pass']) {
    // echo "Dobrodosli $userName";
    // redirekcija na drugu stranicu
    header("Location:admin.html");
} else {
    // echo "Nemate za za ovaj sajt";
    header("Location: zabranjeno.php");
}
