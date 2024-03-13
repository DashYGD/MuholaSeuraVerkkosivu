<?php
if (session_status() == PHP_SESSION_NONE){
  session_start();
}
include "../static/server/connect.php";

if(!isset($_SESSION['muhola_user'])){
  header('Location: ../kirjaudu/server/logout');
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Muhola Seuran Kotisivut</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="../static/images/favicon.ico">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/W3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../static/styles/core.css">
  <link rel="stylesheet" href="styles/styles.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/fi.js"></script>
</head>

<body id="base" style="opacity:0;">
  <button id="scrollPositionBtn" style="display: none;"></button>
  <!-- Page Start -->
  <div id="home" class="bg w3-content" style="max-width:1564px; max-height:2100px;">

    <div id="layer_1" class="w3-content w3-white" style="max-width:1150px; max-height:auto;">

      <!-- Image in Display Container -->
      <div class="w3-display-container w3-content" style="max-width:1150px;">
        <img class="w3-image" src="../static/images/taustaHD.jpeg" alt="Tausta" width="100%">
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
            <a class="w3-hide-small" href="/tapahtumakalenteri">Tapahtumakalenteri</a>
            <a class="w3-hide-small w3-hide-medium" href="/kuvagalleria">Kuvagalleria</a>
          </div>
          <div class="right-buttons">
            <a href="/kirjaudu" role="button" class="w3-right"><span class="loginbutton material-symbols-outlined">login</span></a>
            <button style="border-style:none;" id="myMenubutton" class="menubutton1 w3-right"><span id="openmenu" class="menubutton material-symbols-outlined"></span></button>
          </div>
        </div>

        <div class="mySidebar" id="sidebar">
          <div class="sidebar w3-white w3-card w3-bar-block w3-animate-opacity" id="mySidebar">
            <a href="/etusivu" class="w3-bar-item w3-button">Etusivu</a>
            <a href="/toiminta" class="w3-bar-item w3-button">Toiminta</a>
            <a href="/tapahtumakalenteri" class="w3-bar-item w3-button">Tapahtumakalenteri</a>
            <a href="/kuvagalleria" class="w3-bar-item w3-button">Kuvagalleria</a>
            <a href="/tiedotteet" class="w3-bar-item w3-button">Tiedotteet</a>
          </div>
        </div>
      </div>
      <br>
      <div>
      <form id="applicationForm" action="process_form.php" method="post">
    <div class="content w3-margin-left w3-left" style="width: 48%;">
        <h1>Varaus</h1>
        <p>Sähköposti</p>
        <input type="text" name="email" placeholder="Sähköposti" style="width: 60%;" required>
        <p>Puhelinnumero</p>
        <input type="text" name="phone" placeholder="Puhelinnumero" style="width: 40%;" required>

        <p>Päivämäärä</p>
        <input type="date" name="date" required>
        <br><br>

        <input type="radio" name="vuokra" value="kokous" checked="check">
        <label for="kokous">Kokousvuokra 40,00 €</label><br>
        <input type="radio" name="vuokra" value="paiva">
        <label for="paiva">Päivävuokra 150,00 €</label><br>
        <input type="radio" name="vuokra" value="viikonloppu">
        <label for="viikonloppu">Viikonloppuvuokra 300,00 €</label>
        <br><br>
        <a id="opencalendar" onclick="openCalendar()">Kalenteri</a>
    </div>

    <div class="content w3-margin-left tai">
        <h1>Tai</h1>
        <p>Ota suoraan yhteyttä Asko Rekoseen (+35840 846 5676) halutessasi tehdä varauksen tai saadaksesi lisätietoa asiasta.</p>
    </div>

    <button type="submit" class="footer-link w3-button w3-green" style="width: 100%; margin-bottom: 20px; margin-left: 0; margin-top: 20px;">
        <h5><b>LÄHETÄ HAKEMUS</b></h5>
    </button>
</form>
   
<div id="layer_2" class="w3-content w3-white" style="display: none;">
            <div id="calendar-container">
                <div id="calendar"></div>
                <div id="eventOverlay">
                
                </div>
                    <div id="eventDetails"></div>
            </div>
        </div>


        <div id="bottombar" class="bottombar">
          <span>@Copyright 2024</span>
        </div>
      </div>
      
    </div>
  </div>

  <script type="text/javascript" src="../static/scripts/animation.js"></script>
  <script type="text/javascript" src="../static/scripts/keyboard-accessibility.js"></script>
  <script type="text/javascript" src="../static/scripts/scrollposition.js"></script>
  <script type="text/javascript" src="../static/scripts/sidebar.js"></script>
  <script type="text/javascript" src="../static/scripts/navigationbar.js"></script>
  <script type="text/javascript" src="../static/scripts/opencalendar.js"></script>
</body>

</html>
