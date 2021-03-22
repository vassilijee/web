<?php

// pokretanje sesije?
session_start();

/* ================= Konekcija sa bazom podataka ============================ */
    require_once "konekcija.php";
/* ================= END Konekcija sa bazom podataka ============================ */
require_once("funkcije.php");

$idKorisnika = $_POST['nidKorisnika'] ?? "";
$imeK = $_POST['nimeK'] ?? "";
$prezimeK = $_POST['nprezimeK'] ?? "";
$emailK = $_POST['nemailK'] ?? "";
$privilegijaK = $_POST['nPrivilegijaK'] ?? "";

// ====================================== pretraga po prezimenu ================================
if (isset($_POST['nPretragaPrezimeK'])) {
    if (empty($prezimeK)) {
        die("Morate uneti prezime za pretragu!!!");
    }
    // kreiranje sql upita
    $query = "SELECT * FROM `korisnici` WHERE `prezime`='$prezimeK'";
    echo $query;

    // pozivanje izvrsavanje sql upita
    $rez = $conn->query($query);

    // vardumpovati rez!
    echo "<pre>";
    var_dump($rez);
    echo "</pre>";

    if ($rez->num_rows > 0) {
        echo "<table border=1>
                <tr>
                    <th>idKorisnika</th>
                    <th>ime</th>
                    <th>prezime</th>
                    <th>email</th>
                    <th>privilegija</th>
                    <th>izaberi novu privilegiju<th>
                </tr>";

        while ($red = $rez->fetch_assoc()) {
            echo "<tr>
                    <td>" . $red['idKorisnika'] . "</td>
                    <td>" . $red['ime'] . "</td>
                    <td>" . $red['prezime'] . "</td>
                    <td>" . $red['email'] . "</td>
                    <td>" . $red['privilegija'] . "</td>
                    <td>
                        <form action=obradaAdmin.php method=post enctype=multipart/form-data>
                            <select name=nOpcijePretrageK> 
                                <option value=Admin>Admin</option>
                                <option value=Moderator>Moderator</option>
                                <option value=Korisnik>Korisnik</option>
                            </select>
                        <form>
                    </td>
                  <tr>";
        }
        echo "</table>";
        echo "<input type=submit value=Sacuvaj name=nOdabranaPrivilegija>";

    } else {
        echo "Ne postoji/e studenti sa trazenim prezimenom!!!";
    }
}

// izmena privilegije iz pretrage prezimena
if(isset($_POST['nOdabranaPrivilegija'])){
    $odabrana = $_POST['nOpcijePretrageK'];
    $query = "UPDATE `korisnici` SET `privilegija`='$odabrana' WHERE `prezime`='$prezimeK'";
    echo $query;
    echo $odabrana."<br>";
    var_dump($_POST);
    $rez = $conn->query($query);
    if($rez == false){
        die("Greska, privilegije nisu azurirane: ". $conn->error);
    }
    echo "Podaci su uspesno azurirani!";
}
// ======================================kraj pretraga po prezimenu =============================







// ================================== Slozena pretraga =========================================
if (isset($_POST['nPretraziTerminK'])) {
    if (empty($_POST['nTerminPretrageK'])) {
        die("Morate uneti termin za pretragu!");
    }
    $kategorija = $_POST['nOpcijePretrageK'];
    $termin = $_POST['nTerminPretrageK'];

    $query = "SELECT * FROM `korisnici` WHERE $kategorija = '$termin'";
    $rez = $conn->query($query);
    if ($rez->num_rows > 0) {
        echo "<table border=1>
                <tr>
                    <th>Broj indeksa</th>
                    <th>Prezime</th>
                    <th>Ime</th>
                    <th>Status</th>
                    <th>Sifra smera</th>
                    <th>Slika studenta</th>
                </tr>";
        while ($red = $rez->fetch_assoc()) {
            echo "<tr>
                <td>" . $red['broj_indeksa'] . "</td>
                <td>" . $red['prezime'] . "</td>
                <td>" . $red['ime'] . "</td>
                <td>" . $red['status'] . "</td>
                <td>" . $red['sifra'] . "</td>
                <td><img width='256px' height='256px' src='slike/" . $red['slika'] . "' /></td>
              <tr>";
        }
        echo "</table>";
    } else {
        echo "Trazeni podaci ne postoje u bazi!";
    }
}


// ================================== kraj Slozena pretraga =========================================



// ========================== editovanje postojecih korisnika =================================
if (isset($_POST['nAzuriraj'])) {
    if (empty($brIndeksa) || empty($prezime) || empty($ime) || empty($status) || empty($sifra) || empty($slika['name'])) {
        die("Podaci za izmenu nisu popunjeni");
    }

    //prebacivanje slike na server
    $dozTipFoto = ["image/png", "image/gif", "image/jpeg", "image/svg+xml"];

    // provera da li je uplodovani dokument fotografija sa iznad navedenim tipovima
    if(in_array($slika['type'],$dozTipFoto)==false){
        die("Nedozvoljen tip fotografije!");
    }

    // da li postoji folder u kome zelimo da sacuvamo slike?
    if(is_dir("slike")){
        $source = $slika['tmp_name'];// uzimamo privremenu datoteku
        $original = "slike/".$slika['name'];//odredjujemo putanju za nasu sliku
        move_uploaded_file($source,$original);// prebacivanje tmp fajla na originalnu adresu

    }else{
        mkdir("slike");
        $source = $slika['tmp_name'];// uzimamo privremenu datoteku
        $original = "slike/".$slika['name'];//odredjujemo putanju za nasu sliku
        move_uploaded_file($source,$original);
    }

    $nazivSlike = $slika['name'];

    $query = "UPDATE `student` 
            SET `broj_indeksa`='$brIndeksa',
            `prezime`='$prezime',
            `ime`='$ime',
            `status`='$status',
            `sifra`='$sifra',
            `slika` = '$nazivSlike'
            WHERE `broj_indeksa`='$brIndeksa'";

    $rez = $conn->query($query);
    // provera da li je sql uspesno izvrsen
    if ($rez == false) {
        die("Greska podaci nisu azurirani: " . $conn->error);
    }
    echo "Podaci su uspesno azurirani!";
    session_destroy();
}

