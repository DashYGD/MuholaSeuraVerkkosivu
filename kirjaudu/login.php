<!DOCTYPE html>
<html>
    <head>
        <title>kirjautuminen</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="../static/styles/core.css">
    </head>
<body>

<div class="w3-container">

<div id="home" class="bg w3-content" style="max-width:1564px; max-height:2100px;">

<div id="layer" class="w3-content w3-white" style="max-width:1150px; max-height:2100px;">

<div class="w3-display-container w3-content" style="max-width:1150px;">
        <img class="w3-image" src="../static/images/taustaHD.jpeg" alt="Tausta" width="100%">
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
</body>
</html>