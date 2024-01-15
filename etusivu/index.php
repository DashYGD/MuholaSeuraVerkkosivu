<?php
include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Muhola Seuran Kotisivut</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="http://localhost/static\images\favicon.ico">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/W3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="styles/styles.css">
</head>

<body id="base" style="opacity:0;">
  <button id="scrollPositionBtn" style="display: none;"></button>
  <!-- Page Start -->
  <div id="home" class="bg w3-content" style="max-width:1564px; max-height:2100px;">

    <div id="layer" class="w3-content w3-white" style="max-width:1150px; max-height:2100px;">

      <!-- Image in Display Container -->
      <div class="w3-display-container w3-content" style="max-width:1150px;">
        <img class="w3-image" src="http://localhost/static/images/taustaHD.jpeg" alt="Tausta" width="100%">
      </div>

      <div id="sticky">
        <div id="navbar" class="navbar">

          <div class="left-buttons">
            <button id="myHomebutton" class="w3-left w3-hide-medium w3-hide-large"><span class="homebutton material-symbols-outlined">home</span></button>
            <button class="hidden w3-left w3-hide-small" disabled><span class="material-symbols-outlined">home</span></button>
            <a class="hidden"><button class="w3-left" disabled><span class="material-symbols-outlined">home</span></button></a>
          </div>

          <div class="center-links">
            <a class="active w3-hide-small" href="/etusivu">Etusivu</a>
            <a class="w3-hide-small" href="/toiminta">Toiminta</a>
            <a class="w3-hide-small" href="/kuvagalleria">Kuvagalleria</a>
          </div>
          <div class="right-buttons">
            <a href="/kirjaudu" role="button" class="w3-right"><span class="loginbutton material-symbols-outlined">login</span></a>
            <button style="border-style:none;" id="myMenubutton" class="menubutton1 w3-right"><span id="openmenu" class="menubutton material-symbols-outlined"></span></button>
          </div>
        </div>

        <div class="mySidebar" id="sidebar">
          <div class="w3-white w3-card w3-bar-block w3-animate-opacity" style="display: none; z-index: 5; max-width: 40%; position: absolute; right: 0; border-top-style: outset; border-bottom-style: outset;" id="mySidebar">
            <a href="/etusivu" class="w3-bar-item w3-button">Etusivu</a>
            <a href="/toiminta" class="w3-bar-item w3-button">Toiminta</a>
            <a href="/kuvagalleria" class="w3-bar-item w3-button">Kuvagalleria</a>
          </div>
        </div>
      </div>

      <div class="content">

        <!-- About -->
        <div id="tietoa" class="w3-display-container w3-left w3-content w3-padding-16" style="max-width:55%; padding-left:5%; padding-bottom:5% !important;">
          <?php
          $sql = "SELECT otsikko FROM etusivu";
          $result = $conn->query($sql);
          while ($row = $result->fetch_assoc()) {
            echo "" . $row["otsikko"];
          }
          ?>
          <p>
            <?php
            $sql = "SELECT tietoa FROM etusivu";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
              echo "" . $row["tietoa"];
            }
            ?>
          </p>
          <div id="ytvideo" SameSite="none" style="width:100% max-height:500px;">
            <iframe width="100%" height="100%" src="https://www.youtube-nocookie.com/embed/tgbNymZ7vqY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>

        <div id="tapahtumakalenteri" class="w3-display-container w3-right w3-content w3-padding-48 w3-hide-small w3-hide-medium" style="max-width:40%; width:100%; margin-left:1%; margin-right:3%;">
          <div class="w3-card-4" style="max-width: 100%; text-align:center; overflow: hidden;">

            <header class="w3-container">
              <h1>Tapahtumakalenteri</h1>
            </header>

            <div class="w3-container">
              <p>Lorem ipsum...</p>
            </div>

            <a href="/tapahtumakalenteri" class="footer-link w3-button">
              <h5><b>LISÄÄ</b></h5>
            </a>
          </div>
        </div>

        <div id="hinnasto" class="w3-display-container w3-right w3-content w3-padding-16 w3-hide-small w3-hide-medium" style="max-width:40%; width:100%; margin-left:1%; margin-right:3%; padding-bottom:5% !important;">
          <div class="w3-card-4" style="max-width: 100%; text-align:center; overflow: hidden;">

            <header class="w3-container">
              <h1>Hinnasto</h1>
            </header>

            <div class="w3-container">
              <p>KYLÄTALO VUOKRATTAVISSA erilaisiin tilaisuuksiin edullisesti. Astiasto 100: lle henkilölle.</p>
            </div>

            <div class="w3-container">
              <p><b>Vuokrahinnasto 2023-</b><br><br>
                Kokousvuokra 40,00 €<br>
                Päivävuokra 150,00 €<br>
                Viikonloppuvuokra 300,00 €<br><br>
                Tiedustelut/varaukset Asko Rekonen
              </p>
            </div>

            <a href="/kirjaudu" class="footer-link w3-button">
              <h5><b>VARAA</b></h5>
            </a>
          </div>
        </div>

        <div id="bottombar" class="bottombar">
          <span>@Copyright 2024</span>
        </div>
      </div>
    </div>
  </div>
  
  <script type="text/javascript" src="http://localhost/static/scripts/animation.js"></script>
  <script type="text/javascript" src="http://localhost/static/scripts/keyboard-accessibility.js"></script>
  <script type="text/javascript" src="http://localhost/static/scripts/scrollposition.js"></script>
  <script type="text/javascript" src="http://localhost/static/scripts/sidebar.js"></script>
  <script type="text/javascript" src="http://localhost/static/scripts/navigationbar.js"></script>
</body>

</html>
