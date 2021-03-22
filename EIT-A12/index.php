<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();
    ?>
<fieldset>
<legend>Knjiga utisaka</legend>
<form action="obrada.php" method="post" enctype="multipart/form-data">
            <input type="text" name="nIme" id="iIme" placeholder="unesite ime" value='<?php echo $_SESSION['ime']??""?>'><br>
            <input type="text" name="nEmail" id="iEmail" placeholder="unesite email" value='<?php echo $_SESSION['email']??""?>'><br>
            <input type="text" name="nKomentar" id="iKomentar" placeholder="unesite komentar" value='<?php echo $_SESSION['komentar']??""?>'><br>
            <input type="submit" value="Dodaj" name="nDodajKomentar" id="iDodajKomentar">
        </form>
        </fieldset>
</body>
</body>
</html>