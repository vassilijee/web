var obj = {
  svinja: {
    opis: "Svinja. ",
  },
  konj: {
    opis: "Konj. ",
  },
  kucko: {
    opis: "Kucko. ",
  },
  macka: {
    opis: "Macka. ",
  },
  kokoska: {
    opis: "Kokoska. ",
  }
}

var slika = document.getElementsByTagName('img');

function startZvuk(soundobj) {
  var zvuk = document.getElementById(soundobj);
  zvuk.play();
}
function stopZvuk(soundobj) {
  var zvuk = document.getElementById(soundobj);
  zvuk.pause();
  zvuk.currentTime = 0;
}
for (i = 0; i < slika.length; i++) {
  slika[i].addEventListener('click', function () {
    $('.modal-body').text(obj[this.alt].opis);
  })
}