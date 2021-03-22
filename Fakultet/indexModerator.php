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
 session_start();
 // da li je stranica dostupna sa admin privilegijom ukoliko nije ide na signup formu
 if(!isset($_SESSION['privilegija']) && $_SESSION['privilegija']!=="Moderator"){
     header("Location:signup.html");
 }
?>
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

            <!-- <input type="submit" value="Dodaj" name="nDodaj" id="iDodaj"> -->
            <input type="submit" value="Azuriraj" name="nAzuriraj" id="iAzuriraj"><br>
            <!-- <input type="submit" value="Obrisi" name="nObrisi" id="iObrisi"> <br> -->
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
</body>
</html>