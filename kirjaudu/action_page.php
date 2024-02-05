<?php
// normaalisti haettaisiin käyttäjänimi ja salasana tietokannasta,
// tehdään nyt ajan säästämisesti ns. kovakoodattu käyttäjänimi ja salasana
// MACGYVER-vinkki, älä tee tätä kotona! KÄYTÄ AINA TIETOKANTAA!
session_start(); // sessionia käytetään tarkistamaan että onko kirjautunut

$username = $_POST['usrname'];
$password = $_POST['psw'];

if ($username == "siellalepaa@gmail.com" AND $password == "koira123") {
    $_SESSION['muhola_admin'] = $username; // pääkäyttäjä kirjautuminen
    header('Location: admin'); //siirretään käyttäjä admin sivulle

} elseif($username == "user" AND $password == "qwerty"){
    $_SESSION['muhola_user'] = $username; // käyttäjä kirjautuminen
    header('Location: /etusivu'); //siirretään käyttäjä etusivulle
}
 else {
    // jos salasana tai käyttäjänimi on väärin
    header('Location: login'); //palautetaan käyttäjä login sivulle
}