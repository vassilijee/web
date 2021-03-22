<?php

// pokretanje sesije?
session_start();

/* ================= Konekcija sa bazom podataka ============================ */
    require_once "konekcija.php";
/* ================= END Konekcija sa bazom podataka ============================ */
require_once("funkcije.php");

$brIndeksa = test_input($_POST['nIndeks'] ?? "");
$prezime = $_POST['nPrezime'] ?? "";
$ime = $_POST['nIme'] ?? "";
$status = $_POST['nStatus'] ?? "";
$sifra = $_POST['nSifra'] ?? "";
$slika = $_FILES['nSlika']??"";


// provera unetih podataka po nekom sablonu


// $brIndeksa = filter_var($brIndeksa,FILTER_SANITIZE_STRING);
// $prezime = filter_var($prezime,FILTER_SANITIZE_STRING);
// $ime = filter_var($ime,FILTER_SANITIZE_STRING);
// $status = filter_var($status,FILTER_SANITIZE_STRING);
// $sifra = filter_var($sifra,FILTER_SANITIZE_STRING);



// provera da li je "kliknuto" na taster Dodaj
// ===================================== DODAVANJE NOVOG STUDENTA ==============================
if (isset($_POST['nDodaj'])) {
    if (
        empty($brIndeksa) || empty($prezime) ||
        empty($ime) || empty($status) || empty($sifra) || empty($slika['name'])
    ) {
        //echo "Svi podaci moraju biti uneti";
        die("Niste uneli sve podatke!!!");
    }

    // poziv funkcije za validaciju broja indeksa
    proveraIndeks($brIndeksa);

    // regularni izraz za recimo ime gde se mogu uneti samo slova! (pozvana funkcija za proveru)
    proveraPodataka($prezime);
    proveraPodataka($ime);

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


    //    $query = "INSERT INTO `student` (`broj_indeksa`, `prezime`, `ime`, `status`, `sifra`, `slika`) 
    //    VALUES ('$brIndeksa', '$prezime', '$ime', '$status', '$sifra', '')";

    $query = sprintf(
        "INSERT INTO `student` (`broj_indeksa`, `prezime`, `ime`, `status`, `sifra`, `slika`) 
    VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
        $conn->real_escape_string($brIndeksa),
        $conn->real_escape_string($prezime),
        $conn->real_escape_string($ime),
        $conn->real_escape_string($status),
        $conn->real_escape_string($sifra),
        $conn->real_escape_string($slika['name'])
    );

    echo $query;

    $rez = $conn->query($query);
    if ($rez == false) {
        echo "Upit nije izvrsen:" . $conn->error;
    } else {
        echo "Podaci su uspesno uneti u tabelu!!!";
    }
    session_destroy();
}

// =====================================kraj DODAVANJE NOVOG STUDENTA ==============================



// ====================================== pretraga po prezimenu ================================
if (isset($_POST['nPretragaPrezime'])) {
    if (empty($prezime)) {
        die("Morate uneti prezime za pretragu!!!");
    }
    // kreiranje sql upita
    $query = "SELECT * FROM `student` WHERE `prezime`='$prezime'";
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
                    <th>Broj indeksa</th>
                    <th>Prezime</th>
                    <th>Ime</th>
                    <th>Status</th>
                    <th>Sifra smera</th>
                </tr>";

        while ($red = $rez->fetch_assoc()) {
            echo "<tr>
                    <td>" . $red['broj_indeksa'] . "</td>
                    <td>" . $red['prezime'] . "</td>
                    <td>" . $red['ime'] . "</td>
                    <td>" . $red['status'] . "</td>
                    <td>" . $red['sifra'] . "</td>
                  <tr>";
        }
        echo "</table>";
    } else {
        echo "Ne postoji/e studenti sa trazenim prezimenom!!!";
    }
}
// ======================================kraj pretraga po prezimenu =============================




// ======================================= pretraga po indeksu =================================
if (isset($_POST['nPretragaIndeks'])) {
    if (empty($brIndeksa)) {
        die("Morate uneti broj indeksa studenta kog pretrazujete!");
    }
    $query = "SELECT * FROM `student` where broj_indeksa='$brIndeksa'";
    $rez = $conn->query($query);
    if ($rez->num_rows > 0) {
        $red = $rez->fetch_assoc();

        //kreiranje podataka za sesije
        $_SESSION['indeks'] = $red['broj_indeksa'];
        $_SESSION['prezime'] = $red['prezime'];
        $_SESSION['ime'] = $red['ime'];
        $_SESSION['status'] = $red['status'];
        $_SESSION['sifra'] = $red['sifra'];


        // echo "<table border=1>
        //         <tr>
        //             <th>Broj indeksa</th>
        //             <th>Prezime</th>
        //             <th>Ime</th>
        //             <th>Status</th>
        //             <th>Sifra smera</th>
        //         </tr>";
        // echo "<tr>
        //         <td>".$red['broj_indeksa']."</td>
        //         <td>".$red['prezime']."</td>
        //         <td>".$red['ime']."</td>
        //         <td>".$red['status']."</td>
        //         <td>".$red['sifra']."</td>
        //       <tr>
        //     </table>";
    } else {
        echo "Nemamo studenta sa trazenim brojem indeksa!";
    }
    header("Location:index.php");
}
// ======================================= kraj pretraga po indeksu =================================



// ================================== Slozena pretraga =========================================
if (isset($_POST['nPretraziTermin'])) {
    if (empty($_POST['nTerminPretrage'])) {
        die("Morate uneti termin za pretragu!");
    }
    $kategorija = $_POST['nOpcijePretrage'];
    $termin = $_POST['nTerminPretrage'];

    $query = "SELECT * FROM `student` WHERE $kategorija = '$termin'";
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



// ========================== editovanje postojecih studenata =================================
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

// ========================== kraj editovanje postojecih studenata =================================

// ====================================== Brisanje podataka ========================================
// if(isset($_POST['nObrisi'])){
//     if(empty($brIndeksa)){
//         die("Morate uneti broj indeksa studenta za brisanje");
//     }
//     $query = "DELETE FROM `student` WHERE `broj_indeksa`='$brIndeksa'";
//     $rez = $conn->query($query);
//     if($rez==false){
//         die("Upit nije izvrsen".$conn->error);
//     }
//     echo "Podaci su uspesno izbrisani!";
//     session_destroy();
// }

// prepare statement 
if (isset($_POST['nObrisi'])) {
    if (empty($brIndeksa)) {
        die("Morate uneti broj indeksa studenta za brisanje");
    }

    // kreiranje sql templejta
    $stmt = $conn->prepare("DELETE FROM `student` WHERE `broj_indeksa`=?");
    // povezivanje parametara i vrednosti odnosno tipova parametara
    $stmt->bind_param("s", $brIndeksa);

    //izvrsavanje upita
    $rez = $stmt->execute();

    if ($rez == false) {
        die("Greska: Brisanje podataka nije uspesno - " . $conn->error);
    }
    echo "Uspesno obrisano $conn->affected_rows slogova!";


    session_destroy();
}
// ======================================kraj Brisanje podataka ====================================
