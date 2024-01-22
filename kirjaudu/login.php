<!DOCTYPE html>
<html>
    <head>
        <title>Kirjaudu Sisään</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="../static\images\favicon.ico">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/W3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../static/styles/core.css">
    </head>
<body>

<div class="w3-container">

<div id="home" class="bg w3-content" style="max-width:1564px; max-height:2100px;">

<div id="layer" class="w3-content w3-white" style="max-width:1150px; max-height:2100px;">

<div class="w3-display-container w3-content" style="max-width:1150px;">
        <img class="w3-image" src="../static/images/taustaHD.jpeg" alt="Tausta" width="100%">
      </div>

      <div id="sticky" style="z-index: 1;">
        <div id="navbar" class="navbar" style="z-index: 0">

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
          <div class="sidebar w3-white w3-card w3-bar-block w3-animate-opacity" id="mySidebar">
            <a href="/etusivu" class="w3-bar-item w3-button">Etusivu</a>
            <a href="/toiminta" class="w3-bar-item w3-button">Toiminta</a>
            <a href="/kuvagalleria" class="w3-bar-item w3-button">Kuvagalleria</a>
            <a href="/tapahtumakalenteri" class="w3-bar-item w3-button">Tapahtumakalenteri</a>
          </div>
        </div>
      </div>

    <center>
<h2>Muhola Seura Ry Kirjautuminen</h2>
<button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-blue w3-large" style="margin-bottom: 20px;">Kirjaudu</button>
</center>


<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width: 600px">

        <div class="w3-center"><br>
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
            <img src="images/avatar2.jpg" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
        </div>

        <form class="w3-container" action="action_page" method="POST">
            <div class="w3-section">
                <label><b>Käyttäjänimi</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Aseta käyttäjänimi" name="usrname" required>
                <label><b>Salasana</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Aseta salasana" name="psw" required>
                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Kirjaudu</button>
                <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Muista minut</button>
            </div>
        </form>
        
        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Peruuta</button>
            <span class="w3-right w3-padding w3-hide-small">Unohditko <a href="#">salasanasi?</a></span>
        </div>
    </div>
</div>
<script type="text/javascript" src="../static/scripts/animation.js"></script>
  <script type="text/javascript" src="../static/scripts/keyboard-accessibility.js"></script>
  <script type="text/javascript" src="../static/scripts/scrollposition.js"></script>
  <script type="text/javascript" src="../static/scripts/sidebar.js"></script>
  <script type="text/javascript" src="../static/scripts/navigationbar.js"></script>
  <script type="text/javascript" src="../static/scripts/eventcalendarwidget.js"></script>
</body>
</html>