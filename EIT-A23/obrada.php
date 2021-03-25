<?php
session_start();

require_once "konekcija.php";

$broj = $_POST['nBroj'] ?? "";


   // $query = sprintf(
    //     "INSERT INTO `kartice` (`ImeVlasnika`, `PrezimeVlasnika`, `AdresaVlasnika`, `OstvareniBodovi`, `OstvareniPopust`, `RokVazenja`) 
    // VALUES ('Draginja', 'Zozo', 'Savski nasip 7', '65.00', '0.20', DATE_ADD(now(), INTERVAL 1 YEAR))",
    // );

if (isset($_POST['nDodajKomentar'])) {
    if (empty($broj)) {
        die("Morate uneti prezime za pretragu!!!");
    }
    // kreiranje sql upita
    $query = "SELECT * FROM `kartice` WHERE `BrojKartice`='$broj'";
    echo $query;

    // pozivanje izvrsavanje sql upita
    $rez = $conn->query($query);

    // vardumpovati rez!
    echo "<pre>";
    var_dump($rez);
    echo "</pre>";

    $datumSad = date("Y-m-d");
    
    if ($rez->num_rows > 0) {
        echo "<table border=1>
                <tr>
                    <th>Broj Kartice</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Adresa</th>
                    <th>Ostvareni bodovi</th>
                    <th>Ostvareni popust</th>
                    <th>Rok vazenja</th>
                </tr>";

        while ($red = $rez->fetch_assoc()) {
            echo "<tr>
                    <td>" . $red['BrojKartice'] . "</td>
                    <td>" . $red['ImeVlasnika'] . "</td>
                    <td>" . $red['PrezimeVlasnika'] . "</td>
                    <td>" . $red['AdresaVlasnika'] . "</td>
                    <td>" . $red['OstvareniBodovi'] . "</td>
                    <td>" . $red['OstvareniPopust'] . "</td>
                    <td>" . $red['RokVazenja'] . "</td>
                  <tr>";
                  if($red['RokVazenja']<$datumSad){
                    echo '<span style="color:#AFA;text-align:center;">Kartica ne postoji ili je istekla.</span>';    }
                  }
        }
        echo "</table>";
    } else{
        echo '<span style="color:red;text-align:center;">Kartica ne postoji ili je istekla.</span>';    }
