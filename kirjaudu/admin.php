<?php
$updateSuccess = false;

session_start();
include "../static/server/connect.php";

if (isset($_SESSION['muhola_admin'])) {
    include "server/eventHandler.php";
    
    echo '<!DOCTYPE html>
    <html>
    <title>Admin page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-beta.0/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-beta.0/dist/quill.js"></script>
    <link rel="stylesheet" href="../static/styles/core.css">


    <link rel="stylesheet" href="styles/styles.css">
    <body id="base" style="opacity:0;">';

    echo '<div class="w3-container" ">
    <div class="w3-container w3-green">
    <h2>Muokkaa verkkosivun sisältöä</h2>
    </div>

    <div id="sticky">
        <div id="navbar" class="navbar">

          <div class="center-links">
            <a class="active w3-hide-small" href="#etusivu">Etusivu</a>
            <a class="w3-hide-small" href="#toiminta">Toiminta</a>
            <a class="w3-hide-small" href="#kalenteri">Tapahtumakalenteri</a>
            <a class="w3-hide-small" href="#kuvagalleria">Kuvagalleria</a>
            <a class="w3-hide-small" href="#">Tiedotteet</a>
            <a class="w3-hide-small" href="#">Käyttäjät</a>
          </div>
        </div>

        </div>
      </div>
    ';

    echo '
    <div class="w3-card-4" id="etusivu_1" style="border-style: outset; background-color:white;">
    <div class="w3-container w3-green" id="etusivu">
    <h2>Etusivu</h2>
    </div>
    
    <form method="POST" class="w3-container" id="form_1">
    <h3>Tietoa meistä</h3>
    <p>
    <div id="editor_1" name="tietoameista_1">';

    $sql1 = "SELECT tietoa FROM etusivu";
    $result= $conn->query($sql1);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row["tietoa"];
        }
    }

    echo '</div></p>
    <input type="hidden" name="tietoameista_1" id="tietoameista-input_1">

    <input type="submit" name="submit_1" value="Muokkaa" onclick="updateHiddenInputs_1()">
    </form><br>
    </div>';
    echo '<br>';

    echo '<div class="w3-card-4" style="padding-left:5%; padding-right:5%; background-color:white; border-style: outset;"><br>
    <span>';

    $sql1 = "SELECT tietoa FROM etusivu";
    $result= $conn->query($sql1);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row["tietoa"];
        }
    }

    echo '<br></span> </div>';

    echo '<br><br><br>';

    echo '
    <div class="w3-card-4" id="toiminta" style="border-style: outset; background-color:white;">
    <div class="w3-container w3-green">
    <h2>Tietoa toiminnasta</h2>
    </div>
    
    <form method="POST" class="w3-container"  id="form_2">
    <h3>Teksti</h3>
    <p>
    <div id="editor_2" name="tietoatoiminta_1">';

    $sql2 = "SELECT tietoa_1 FROM toiminta";
    $result= $conn->query($sql2);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row["tietoa_1"];
        }
    }

    echo '</div></p>';
    echo'
    <input type="hidden" name="tietoatoiminta_1" id="tietoatoiminta-input_1">
    
    <input type="submit" name="submit_2" value="Muokkaa" onclick="updateHiddenInput_2()">
    </form><br>
    </div>';

    echo '<br>';

    echo '<div class="w3-card-4" style="padding-left:5%; padding-right:5%; background-color:white; border-style: outset;"><br>
    <span>';

    $sql2 = "SELECT tietoa_1 FROM toiminta";
    $result= $conn->query($sql2);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row["tietoa_1"];
        }
    }

    echo '<br></span> </div>';

    echo '<br><br><br>';

    echo '
    <div class="w3-card-4" style="border-style: outset; background-color:white;" id="eventCalendar">
  <div class="w3-container w3-green" id="kalenteri">
    <h2>Tapahtumakalenteri</h2>
  </div>





  <form method="POST" class="w3-container" id="searchForm_1" style="display:flex; position: relative; flex-direction: column; max-width: 100%; margin: 2%; justify-content: center; align-items: center;">
  <input
    type="text"
    id="searchInput_2"
    oninput="searchEvents(event)"
    name="searchInput_2"
    placeholder="Hae tapahtumia"
    style="display:flex; position: relative; width: 100%;"
  />
  <input type="hidden" id="submitButton" name="submitButton">
  <div style="display:flex; position: relative; flex-direction: column; width: 100%; align-items: center;">
  <div class="w3-bar-block w3-white w3-card" style="display:flex; position: absolute; flex-direction: column; align-item: center; justify-content:center; z-index:5; margin-left: 2%; margin-right: 2%; width:100%;" id="searchResultsContainer"></div>
  </div>
  </form>

<div id="searchResults" class="w3-container">';
if (isset($events) && !isset($_POST['clearEventForm'])) {
    while ($row = mysqli_fetch_assoc($events)) {
        echo '<div><p>';
        echo '<form method="POST" class="w3-container" id="form__' . $row['id'] . '">';
        echo '<input type="hidden" name="eventId" value="' . $row['id'] . '">';
        echo '<p><label>Päivämäärä:</label>';
        echo '<input type="date" name="newDate" value="' . $row['päivä'] . '"></p>';
        echo '<p><label>Otsikko:</label>';
        echo '<input type="text" name="newTitle" value="' . $row['otsikko'] . '"></p>';
        echo '<br><label>Tietoa tapahtumasta:</label><br>';
        echo '<div id="editor__' . $row['id'] . '" style="max-height: 150px;">' . $row['tietoa'] . ' </div>';
        echo '<p><input type="submit" name="updateEvent" onclick="updateHiddenInput__' . $row["id"] . '(); " value="Päivitä">';
        echo '<input type="hidden" name="newDescription__' . $row["id"] . '" id="newDescription__' . $row["id"] . '">
        <form method="POST" class="w3-container" id="clearEventForm">
        <input type="submit" name="clearEvents" id="clearEvents" value="Lisää uusi">
        </form></p></form></div>';
                
        echo '<script>var quill__' . $row['id'] . ' = new Quill("#editor__' . $row['id'] . '", { theme: "snow", name: "newDescription__' . $row["id"] . '" });
            
                console.log(document.getElementById("newDescription__' . $row["id"] . '").value);
                function updateHiddenInput__' . $row["id"] . '() {
                    var quillContent = quill__' . $row['id'] . '.root.innerHTML;
                    console.log(quillContent);
                            

                    document.getElementById("newDescription__' . $row["id"] . '").value = quillContent;
                }
            </script>';
    }
} 
if (!isset($events) || isset($_POST['clearEventForm'])){
    echo '<div>';
    echo '<form method="POST" class="w3-container" id="newEventForm">';
    echo '<p><label>Päivämäärä:</label>';
    echo '<input type="date" name="newDate" required></p>';
    echo '<p><label>Otsikko:</label>';
    echo '<input type="text" name="newTitle" required></p>';
    echo '<br><label>Tietoa tapahtumasta:</label><br>';
    echo '<div id="editor_newEvent" style="max-height:200px;"></div>';
    echo '<p><input type="submit" name="addEvent" onclick="updateHiddenInput_5();" value="Lisää"></p>';
    echo '<input type="hidden" name="newDescription_1" id="newDescription_1">';
    echo '</form></div>';

    echo '<script>
        var quill_new_1;

        function initQuill() {
            if (!quill_new_1) {
                quill_new_1 = new Quill("#editor_newEvent", { theme: "snow" });
            }
        }

        function updateHiddenInput_5() {
            if (quill_new_1) {
                var quillContent = quill_new_1.root.innerHTML;
                console.log(quillContent);
                document.getElementById("newDescription_1").value = quillContent;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            initQuill();
        });
          
    </script>';
}

         echo '

    <br>
    </div></div> ';

    echo '<br><br><br>';


    echo '
    <div class="w3-card-4" style="border-style: outset; background-color:white; margin-bottom: 40px;">
    <div class="w3-container w3-blue" id="kuvagalleria">
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
    </div></div></div>

    
    <script type="text/javascript" src="../static/scripts/animation.js"></script>
    <script type="text/javascript" src="scripts/quill.js"></script>';
    





echo <<<EOL
<script>
var form=document.getElementById("searchForm_1");


document.addEventListener('DOMContentLoaded', function () {
    console.log('Stored Event ID:', storedEventId);

    // Set the value of submitButton based on storedEventId
    var submitButtonInput = document.getElementById('submitButton');
        var storedEventId = localStorage.getItem("selectedEventId");
        console.log('Stored Event ID:', storedEventId, submitButtonInput.value);

        submitButtonInput.value = storedEventId;

});



function selectEvent(selectedOption) {
    var selectedEventId = selectedOption.getAttribute('data-event-id');
    var selectedEventValue = selectedOption.getAttribute('name');
    var form = document.getElementById('searchForm_1');

    console.log('Selected Event ID:', selectedEventId);
    console.log(selectedEventValue);

    document.getElementById('searchInput_2').value = selectedEventValue;
    localStorage.setItem('selectedEventId', selectedEventId);
    document.getElementById('submitButton').value = selectedEventId;

    localStorage.setItem('containerId', document.getElementById("eventCalendar").getAttribute('id'));

    form.submit();
}



function updateSearchResults(results) {
    var searchResultsContainer = document.getElementById('searchResultsContainer');
    searchResultsContainer.innerHTML = '';

    for (var i = 0; i < results.length; i++) {
      var resultItem = document.createElement('div');
      resultItem.innerHTML = '<div style=" text-align: center; " class="scrollpos w3-bar-item w3-button" onclick="selectEvent(this)" name="' + results[i].otsikko + '" data-event-id="' + results[i].id + '">' + results[i].otsikko + '</div>';

      searchResultsContainer.appendChild(resultItem);
    }

    var elements = document.getElementsByClassName('scrollpos');

for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener('click', function() {
        console.log(elements[i]);
        localStorage.setItem('scrollPosition', window.scrollY);
    });
}
  }

function searchEvents(event) {
  
    var input = document.getElementById('searchInput_2').value;
    var searchResultsContainer = document.getElementById('searchResultsContainer');
    
  
    if (input.length >= 1) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var results = JSON.parse(xhr.responseText);
          updateSearchResults(results);
        }
      };
  
      xhr.open('GET', 'server/search_events.php?query=' + input, true);
      xhr.send();
      console.log(input);
    } else {
      searchResultsContainer.innerHTML = '';
    }
    return true;
  }
</script>

<script type="text/javascript" src="scripts/scrollposition.js"></script> 
EOL;




} else {
    header('Location: login');
    exit();
}



if (isset($_POST['sendfile'])) {
    $file = $_FILES['filename'];

    $fileName = $_FILES['filename']['name'];
    $fileTmpName = $_FILES['filename'] ['tmp_name'];
    $fileSize = $_FILES['filename']['size'];
    $fileError = $_FILES['filename']['error'];
    $fileType = $_FILES['filename']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed= array('jpg', 'png', 'jpeg');

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
echo '</body>';