<?php
$updateSuccess = false;

session_start();
include "connect.php";

// Check if the user is logged in
if (isset($_SESSION['muhola_admin'])) {
    // Check if the form is submitted
    if (isset($_POST['submit_1'])) {

        if (isset($_POST['scrollPosition'])) {
            $_SESSION['scrollPosition'] = $_POST['scrollPosition'];
        }
        
        // Set the scroll position cookie
        setcookie('scrollPosition', $_SESSION['scrollPosition'], time() + 3600, '/');

        $otsikko = $_POST['otsikko_1'];
        $tietoameista = $_POST['tietoameista_1'];

        // Update the 'otsikko' table
        $sql1 = "UPDATE etusivu SET otsikko = '$otsikko'";
        $result1 = mysqli_query($conn, $sql1);

        // Update the 'tietoa' table
        $sql2 = "UPDATE etusivu SET tietoa = '$tietoameista'";
        $result2 = mysqli_query($conn, $sql2);

        // Set the success flag based on the update results
        $updateSuccess = ($result1 && $result2);

        // Redirect to 'admin' only if the update was successful
        if ($updateSuccess) {
            header('Location: admin');
            exit(); // Ensure that no further code is executed after the redirect
        }
    }
    if (isset($_POST['submit_2'])) {

        
        if (isset($_POST['scrollPosition'])) {
            $_SESSION['scrollPosition'] = $_POST['scrollPosition'];
        }
        
        // Set the scroll position cookie
        setcookie('scrollPosition', $_SESSION['scrollPosition'], time() + 3600, '/');

        $tietoatoiminta = $_POST['tietoatoiminta_1'];

        $sql3 = "UPDATE toiminta SET tietoa_1 = '$tietoatoiminta'";
        $result3 = mysqli_query($conn, $sql3);

        // Set the success flag based on the update results
        $updateSuccess = ($result3);

        // Redirect to 'admin' only if the update was successful
        if ($updateSuccess) {
            header('Location: admin');
            exit(); // Ensure that no further code is executed after the redirect
        }
    }







echo '<!DOCTYPE html>
<html>
<title>Admin page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-beta.0/dist/quill.snow.css" rel="stylesheet" />
<body>';

echo '<div class="w3-container">
<h2>Muokkaa verkkosivun sisältöä</h2>
';

echo '
<div class="w3-card-4"  style="border-style: outset;">
<div class="w3-container w3-green">
<h2>Etusivu</h2>
</div>


<form method="POST" class="w3-container" id="yourFormId1">
<h3>Otsikko</h3>
<p>
<div id="editor_1" name="otsikko_1">';

// tulostaa tietokannasta datan
    $sql1 = "SELECT otsikko FROM etusivu";
$result= $conn->query($sql1);
if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc()) {
        echo $row["otsikko"];
    }
}

echo '</div></p>
<input type="hidden" name="otsikko_1" id="otsikko-input_1">

<h3>Tietoa meistä</h3>
<p>
<div id="editor_2" name="tietoameista_1">';

// tulostaa tietokannasta datan
    $sql2 = "SELECT tietoa FROM etusivu";
$result= $conn->query($sql2);
if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc()) {
        echo $row["tietoa"];
    }
}

echo '</div></p>
<input type="hidden" name="tietoameista_1" id="tietoameista-input_1">

<input type="hidden" name="scrollPosition" id="scrollPosition" value="<?php echo $scrollPosition; ?>">

<input type="submit" name="submit_1" value="Muokkaa" onclick="updateHiddenInputs_1()">



</form><br>
</div>';
echo '<br>';

echo '<div class="w3-card-4" style="padding-left:5%; padding-right:5%; background-color:white; border-style: outset;"><br>
<span>';


// tulostaa tietokannasta datan
    $sql1 = "SELECT otsikko FROM etusivu";
$result= $conn->query($sql1);
if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc()) {
        echo $row["otsikko"];
    }
}

// tulostaa tietokannasta datan
    $sql2 = "SELECT tietoa FROM etusivu";
$result= $conn->query($sql2);
if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc()) {
        echo $row["tietoa"];
    }
}



echo '<br></span> </div>';

echo '<br><br><br>';

echo '
<div class="w3-card-4"  style="border-style: outset;">
<div class="w3-container w3-green">
<h2>Tietoa toiminnasta</h2>
</div>


<form method="POST" class="w3-container"  id="yourFormId2">
<h3>Teksti</h3>
<p>
<div id="editor_3" name="tietoatoiminta_1">';

// tulostaa tietokannasta datan
    $sql3 = "SELECT tietoa_1 FROM toiminta";
$result= $conn->query($sql3);
if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc()) {
        echo $row["tietoa_1"];
    }
}

echo '</div></p>';


$scrollPosition = isset($_SESSION['scrollPosition']) ? (int)$_SESSION['scrollPosition'] : 0;

echo '<input type="hidden" name="scrollPosition" id="scrollPosition" value="' . $scrollPosition . '">';

// Clear the session variable after using it to set the hidden input value
unset($_SESSION['scrollPosition']);

echo'
<input type="hidden" name="tietoatoiminta_1" id="tietoatoiminta-input_1">

<input type="submit" name="submit_2" value="Muokkaa" onclick="updateHiddenInput_3()">



</form><br>
</div>';

echo '<br>';

echo '<div class="w3-card-4" style="padding-left:5%; padding-right:5%; background-color:white; border-style: outset;"><br>
<span>';


// tulostaa tietokannasta datan
    $sql3 = "SELECT tietoa_1 FROM toiminta";
$result= $conn->query($sql3);
if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc()) {
        echo $row["tietoa_1"];
    }
}



echo '<br></span> </div>';

echo '<br><br><br>';


echo '
<div class="w3-card-4">
<div class="w3-container w3-blue">
<h2>Kuvagalleria</h2>
</div>
<form class="w3-container" method="POST" enctype="multipart/form-data">
<p>
<input placeholder="Tietoa kuvasta" class="w3- input" type="text" name="kohteennimi">
<p>Lisää kuva, suositeltu koko: 1920x1080</p>
<input type="file" id="myFile" name="filename">
<input type="submit" name="sendfile">
</form>
<br>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-beta.0/dist/quill.js"></script>
<script type="text/javascript" src="quill.js"></script> 
';
} else {
    header('Location: login');
    exit(); // Ensure that no further code is executed after the redirect
}

?>
<?php


if (isset($_POST['sendfile'])) {
    $file = $_FILES['filename']; #uusi $_FILES hakee tiedoston .. vähän sama kuin $POST-yms.

    $fileName = $_FILES['filename']['name'];
    $fileTmpName = $_FILES['filename'] ['tmp_name'];
    $fileSize = $_FILES['filename']['size'];
    $fileError = $_FILES['filename']['error'];
    $fileType = $_FILES['filename']['type'];

    $fileExt = explode('.', $fileName); # erotellaan tiedostonimi tiedostopäätteestā
    $fileActualExt = strtolower(end($fileExt)); #muutetaan tiedoston loppupääte kokonaan pienellä kirjoitetuksi.

    $allowed= array('jpg', 'png', 'jpeg'); #kerrotaan millasia tiedostoja päästetään läpi

    $kohteennimi = mysqli_real_escape_string($conn, $_POST["kohteennimi"]);

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 50000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'images/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = "INSERT INTO kohteet (nimi, kuva)
VALUES ('$kohteennimi', '$fileNameNew');";
mysqli_query ($conn, $sql);
        echo "onnistui";
    } else {
        echo "Tiedosto on liian iso.";
    }
    } else {
        echo "Tapahtui virhe";
    }
    } else {
        echo "väärän tyyppinen tiedosto";
    }
}

?>