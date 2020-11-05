<?php

// nUserName se odnosi na polje sa forme cije je name atribut imao ovu vrednost
$userName = $_GET['nUserName']??"Nepoznati korisnik";
$pass = $_GET['nPassword'];

echo "Dobrodosli $userName";