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
    
    <style>
      *:focus {
        outline: none;
      }
    </style>

<body id="base" style="opacity:0;">

<div class="w3-container">

<div id="home" class="bg w3-content" style="max-width:1564px; max-height:2100px;">

<div id="layer" class="w3-content w3-white" style="max-width:1150px; max-height:2100px; border-style: outset;">

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
</center>

        <form class="w3-container" action="action_page" method="POST">
            <div class="w3-section">
                <label><b>Käyttäjänimi/Sähköposti</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Aseta käyttäjänimi tai sähköposti" name="usrname" required>
                <label><b>Salasana</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Aseta salasana" name="psw" required>
                <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Muista minut</button>
                <span class="w3-right w3-margin-top w3-padding w3-hide-small">Unohditko <a href="#">salasanasi?</a></span>
                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Kirjaudu</button>
                
            </div>
        </form>
    

<script type="text/javascript" src="../static/scripts/animation.js"></script>
  <script type="text/javascript" src="../static/scripts/keyboard-accessibility.js"></script>
  <script type="text/javascript" src="../static/scripts/sidebar.js"></script>
  <script type="text/javascript" src="../static/scripts/navigationbar.js"></script>
</body>
</html>