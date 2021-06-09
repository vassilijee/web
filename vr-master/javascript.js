var tekst = document.getElementById("tekst");

$(".mala").click(function () {
  var src = $(this).attr("src")
  $("#velika").attr("src", src);
});

$(".mala").click(function () {
  var brojslike = $(this).attr("id")
  $("#tekst").text("Slika " + brojslike);
});