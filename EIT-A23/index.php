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
            <input type="text" name="nBroj" id="iIme" placeholder="unesite broj kartice" value='<?php echo $_SESSION['broj']??""?>'><br>
            <input type="submit" value="Dodaj" name="nDodajKomentar" id="iDodajKomentar">
        </form>
        </fieldset>
</body>
</body>
</html>