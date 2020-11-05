<?php

// isset
if (
    (isset($_POST['nUserName']) && isset($_POST['nPassword']))
    &&
    // (!empty($_POST['nUserName']) && !empty($_POST['nPassword']))
    // &&
    (count($_POST['nUserName']) > 0 && count($_POST['nPassword']) > 0)
) {
    echo "<h3>Podaci su uneti! </h3>";
} else {
    echo "<h3>Niste uneli podatke. </h3>";
}

// empty
// if (!empty($_POST['nUserName']) && !empty($_POST['nPassword'])) {
//     echo "<h3>Podaci su uneti! </h3>";
// } else {
//     echo "<h3>Niste uneli podatke. </h3>";
// }
