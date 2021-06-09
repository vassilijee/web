<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

/*
    Kreirati stranicu koja ce omoguciti samo Administratoru da
    izmeni trenutnu privilegiju postojecem useru.
*/

// 1. konekcija
// 2. pretraga sa prikazom
// 3. ukljuciti adekvatan sistem za promenu privilegije *select, *radiobutton...
// 4. prihvatiti izmene u upitu za azuriranje
// 5. izvrsiti upit

session_start();

if(!isset($_SESSION['privilegija']) && $_SESSION['privilegija']!=="Admin"){header("Location:signup.html");}
?>
<!-- za studente -->
<h1>Unos azuriranje podataka o studentima</h1>
    <fieldset>
        <legend>Studenti</legend>

        <form action="obrada.php" method="post" enctype="multipart/form-data">
            <input type="text" name="nIndeks" id="iIndeks" placeholder="unesite broj indeksa" value='<?php echo $_SESSION['indeks']??"" ?>'><br>
            <input type="text" name="nPrezime" id="iPrezime" placeholder="unesite prezime" value='<?php echo $_SESSION['prezime']??"" ?>'><br>
            <input type="text" name="nIme" id="iIme" placeholder="unesite ime" value='<?php echo $_SESSION['ime']??"" ?>'><br>

            <?php
                if(isset($_SESSION['status'])){
                    if($_SESSION['status']=='S'){
                        $statusS = "checked";
                    }else{
                        $statusB = "checked";
                    }
                }
            ?>

            <label for="iStatusB">Budzet</label>
            <input type="radio" name="nStatus" id="iStatusB" value="B" <?php echo $statusB??"" ?> >

            <label for="iStatusS">Samofinansiranje</label>
            <input type="radio" name="nStatus" id="iStatusS" value="S" <?php echo $statusS??"" ?>><br>

            <input type="text" name="nSifra" id="iSifra" placeholder="unesite sifru smera" value='<?php echo $_SESSION['sifra']??"" ?>'><br>
            <input type="file" name="nSlika" id="iSlika"><br><br>

            <input type="submit" value="Dodaj" name="nDodaj" id="iDodaj">
            <input type="submit" value="Azuriraj" name="nAzuriraj" id="iAzuriraj">
            <input type="submit" value="Obrisi" name="nObrisi" id="iObrisi"> <br>
            <input type="submit" value="Trazi po prezimenu" name="nPretragaPrezime" id="iPretragaPrezime">
            <input type="submit" value="Trazi po indeksu" name="nPretragaIndeks" id="iPretragaIndeks">
            <input type="reset" value="Reset" name="nReset" id="iReset"><br>

            <select name="nOpcijePretrage" id="iOpcijePretrage">
                <option value="broj_indeksa">Broj indeksa</option>
                <option value="prezime">Prezime</option>
                <option value="ime">Ime</option>
                <option value="status">Status</option>
                <option value="sifra">Sifra smera</option>
            </select>

            <input type="text" name="nTerminPretrage" id="iTerminPretrage" placeholder="unesite termin pretrage...">
            <input type="submit" value="Pretrazi" name="nPretraziTermin" id="iPretraziTermin">

        </form>

    </fieldset>
    <?php require_once "logoutLink.php"; ?>

<!-- za korisnike -->
<h1>Unos azuriranje podataka o korisnicima</h1>

<fieldset>
<legend>Korisnici</legend>

<form action="obradaAdmin.php" method="post" enctype="multipart/form-data">
    <input type="text" name="nidKorisnika" id="iIndeks" placeholder="unesite id korisnika" value='<?php echo $_SESSION['indeks']??"" ?>'><br>
    <input type="text" name="nprezimeK" id="iPrezime" placeholder="unesite prezime" value='<?php echo $_SESSION['prezime']??"" ?>'><br>
    <input type="text" name="nimeK" id="iIme" placeholder="unesite ime" value='<?php echo $_SESSION['ime']??"" ?>'><br>
    <input type="text" name="nemailK" id="iIme" placeholder="unesite email" value='<?php echo $_SESSION['ime']??"" ?>'><br>

    <!-- <input type="submit" value="Dodaj" name="nDodaj" id="iDodaj"> -->
    <input type="submit" value="Azuriraj" name="nAzuriraj" id="iAzuriraj"><br>
    <!-- <input type="submit" value="Obrisi" name="nObrisi" id="iObrisi"> <br> -->
    <input type="submit" value="Trazi po prezimenu" name="nPretragaPrezimeK" id="iPretragaPrezimeK">
    <input type="submit" value="Trazi po indeksu" name="nPretragaIndeks" id="iPretragaIndeks">
    <input type="reset" value="Reset" name="nReset" id="iReset"><br>

    <select name="nOpcijePretrage" id="iOpcijePretrage">
        <option value="broj_indeksa">Broj indeksa</option>
        <option value="prezime">Prezime</option>
        <option value="ime">Ime</option>
        <option value="status">Status</option>
        <option value="sifra">Sifra smera</option>
    </select>

    <input type="text" name="nTerminPretrage" id="iTerminPretrage" placeholder="unesite termin pretrage...">
    <input type="submit" value="Pretrazi" name="nPretraziTermin" id="iPretraziTermin">

</form>

</fieldset>
<?php require_once "logoutLink.php"; ?>