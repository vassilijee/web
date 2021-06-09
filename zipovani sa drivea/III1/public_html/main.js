let taster = document.querySelectorAll('input[type=button]');
console.log(taster);
let niz = []; // globalni niz

taster[0].addEventListener('click', function () {
    let obj = {
        ime: document.getElementById('ime').value,
        god: document.getElementById('god').value,
        email: document.getElementById('email').value
    };
    niz.push(obj);//niz[niz.length-1]=obj

    console.log(niz);
    // konverzija u JSON
    let str = JSON.stringify(niz);

    // lokalno cuvanje podataka u Local Storage
    localStorage.setItem('mojObj', str);// postavka podataka u LS
    console.log(str);//JSON

    getNiz = JSON.parse(localStorage.getItem('mojObj'));
    console.log(getNiz);
});
