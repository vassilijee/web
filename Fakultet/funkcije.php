<?php

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// kreirati funkciju za filtriranje broja indeksa i to u formatu 001/21
// prve tri karaktera su cifre nakon toga ide / i nakon toga godina upisa koja moze
// biti 21 ili 22 ili 23
// reg: ^\d{3}\/2[1-3]$

function proveraIndeks($data)
{
  if (preg_match('/^\d{3}\/2[1-3]$/', $data) == false) {
    die("Broj indeksa nije adekvatan! Format mora biti npr:111/22");
  }
}

function proveraPodataka($data)
{
  if (preg_match('/^[A-Z][a-z]{2,15}$/', $data) == false) {
    die("Podatak mora pocinjati velikim slovom i mora imati samo slova do 16 karaktera!");
  }
  return $data;
}


// funkcija za validaciju password-a
function proveraPass($param){
  // provera da li password sadrzi veliko slovo
  $prVelikaSlova = preg_match("/[A-Z]/",$param);
  // provera da li password sadrzi mala slova
  $prMalaSlova = preg_match("/[a-z]/",$param);
  // provera da li password sadrzi brojeve
  $prBrojke = preg_match("/[0-9]/",$param);
  // provera da li password sadrzi specijalni znak
  $prSpecKaraktera = preg_match("/[^A-Za-z0-9\s]/",$param);//ok

  // provera da li je gore navedeno obuhvaceno sa brojem karaktera od 8.
  if(strlen($param)>=8 && $prVelikaSlova && $prMalaSlova && $prBrojke && $prSpecKaraktera){
    return $param;
  }else{
    die("Sifra nije u odgovarajucem formatu");
  }

}