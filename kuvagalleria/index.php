<?php
include "../static/server/connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Muhola Seuran Kotisivut</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="../static\images\favicon.ico">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/W3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" href="../static/styles/core.css">
</head>

<body id="base" style="opacity:0;"> <!-- Sivulla ei näy mitään, koska tuo mysql:stä haettu kuvan path ei toimi, sitkun toimii niin pitäisi animaatiokin toimia -->
  <button id="scrollPositionBtn" style="display: none;"></button>
  <!-- Page Start -->
  <div id="home" class="bg w3-content" style="max-width:1564px; max-height:2100px;">

    <div id="layer_1" class="w3-content w3-white" style="max-width:1150px; max-height:5000px;">

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
          <div class="w3-white w3-card w3-bar-block w3-animate-opacity" style="display: none; z-index: 5; max-width: 40%; position: absolute; right: 0; border-top-style: outset; border-bottom-style: outset;" id="mySidebar">
            <a href="/etusivu" class="w3-bar-item w3-button">Etusivu</a>
            <a href="/toiminta" class="w3-bar-item w3-button">Toiminta</a>
            <a href="/tapahtumakalenteri" class="w3-bar-item w3-button">Tapahtumakalenteri</a>
            <a href="/kuvagalleria" class="w3-bar-item w3-button">Kuvagalleria</a>
          </div>
        </div>
      </div>

      <!--About-->
      <div id="kuvagalleria" class="gallery-container w3-display-container w3-content w3-padding-16" style="max-width:1150px; max-height:5000px;">
           <?php
          $sql = "SELECT * FROM kuvagalleria";
          $result = $conn->query($sql);
          while ($row = $result->fetch_assoc()) {
            echo '
            <div class="gallery">
            <div class="img-title">' . $row["kuva_otsikko"] . '</div>';
            echo '<a target="_blank" href="' . $row['kuva'] . '">';
            echo '<img src="' . $row["kuva"] . '" alt="testi_kuva"><br>';
            echo '</a>
            <div class="img-desc"><p>'. $row["kuva_tietoa"] . '</p></div>
          </div>';
          }
          ?>
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
</body>

</html>
      
</body>