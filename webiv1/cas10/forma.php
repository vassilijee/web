<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php require "header.php"; ?>
    <!-- <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> -->
    <form action="obrada.php" method="POST">
        <input type="text" name="nIme" id="iIme" placeholder="unesite ime" pattern="[A-Za-z]{3,15}"> <br>
        <input type="email" name="nEmail" id="iEmail" placeholder="unesite email...">
        <fieldset>
            <legend>Pol:</legend>

            <label for="iMuski">Muski:</label>
            <input type="radio" name="nPol" id="iMuski" value="Muski">
            <label for="iZenski">Zenski:</label>
            <input type="radio" name="nPol" id="iZenski" value="Zenski">

        </fieldset>

        <fieldset>
            <legend>Hrana:</legend>
            <label for="iPizza">Pizza</label>
            <input type="checkbox" name="nHrana[]" id="iPizza" value="Pizza">

            <label for="iBurger">Burger</label>
            <input type="checkbox" name="nHrana[]" id="iBurger" value="Burger">

            <label for="iBurek">Burek</label>
            <input type="checkbox" name="nHrana[]" id="iBurek" value="Burek">

            <label for="iMantije">Mantije</label>
            <input type="checkbox" name="nHrana[]" id="iMantije" value="Mantije">
        </fieldset>

        <!-- Select za dodatne opcije -->
        <fieldset>
            <legend>Opcije placanja</legend>
            <select name="nPlacanje" id="iPlacanje">
                <option value="---">---odaberite opciju---</option>
                <option value="kes">kes</option>
                <option value="kartica">kartica</option>
                <option value="cripto">cripto coin</option>
            </select>
        </fieldset>
        <br>

        <input type="submit" value="Ok">
    </form>

    <hr>

    <?php include "footer.php"; ?>

</body>

</html>