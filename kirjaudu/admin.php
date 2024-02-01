<?php
session_start();
include "../static/server/connect.php";

// Check if user is logged in
if (!isset($_SESSION['muhola_admin'])) {
    header('Location: login');
    exit();
}

include "server/eventHandler.php";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-beta.0/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-beta.0/dist/quill.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="scripts/navigation.js"></script>
    <link rel="stylesheet" href="../static/styles/core.css">
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body id="base" style="opacity:0;">
    
    <!-- Navigation bar -->
    <div id="sticky">
        <div id="navbar" class="navbar">
            <div class="left-buttons">
                <button id="myHomebutton" class="w3-left w3-hide-medium w3-hide-large"><span class="homebutton material-symbols-outlined">home</span></button>
                <button class="hidden w3-left w3-hide-small" disabled><span class="material-symbols-outlined">home</span></button>
                <a class="hidden"><button class="w3-left" disabled><span class="material-symbols-outlined">home</span></button></a>
            </div>

            <div class="center-links">
                <a class="active w3-hide-small" href="#" onclick="toggleSection('etusivu_1')">Etusivu</a>
                <a class="w3-hide-small" href="#" onclick="toggleSection('toiminta_1')">Toiminta</a>
                <a class="w3-hide-small" href="#" onclick="toggleSection('tapahtumakalenteri_1')">Tapahtumakalenteri</a>
            </div>
                <div class="right-buttons">
                <a href="#" id="logoutButton" role="button" class="w3-right"><span class="loginbutton material-symbols-outlined">login</span></a>
                <button style="border-style:none;" id="myMenubutton" class="menubutton1 w3-right"><span id="openmenu" class="menubutton material-symbols-outlined"></span></button>
            </div>
        </div>

        <div class="mySidebar" id="sidebar">
            <div class="sidebar w3-white w3-card w3-bar-block w3-animate-opacity" id="mySidebar">
            <a class="active w3-hide-small" href="#" onclick="toggleSection('etusivu_1')">Etusivu</a>
            <a class="w3-hide-small" href="#" onclick="toggleSection('toiminta_1')">Toiminta</a>
            <a class="w3-bar-item w3-button">Kuvagalleria</a>
            <a href="/tapahtumakalenteri" class="w3-bar-item w3-button">Tapahtumakalenteri</a>
            </div>
        </div>
    </div><br>

    <!-- Content sections -->
    <div class="w3-container">
        <!-- Section 1: Etusivu -->
        <div class="sections" id="etusivu_1">
            <div class="w3-card-4 w3-white">
                <div class="w3-container w3-green">
                    <h2>Etusivu</h2>
                </div>
                <form method="POST" class="w3-container" id="form_1">
                    <h3>Tietoa meistä</h3>
                    <p><div id="editor_1" name="tietoameista_1">

                        <?php
                        $sql1 = "SELECT tietoa FROM etusivu";
                        $result= $conn->query($sql1);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo $row["tietoa"];
                            }
                        }
                        ?>
                    </div></p>
                    <!-- Inputs -->
                    <input type="hidden" name="tietoameista_1" id="tietoameista-input_1">
                    <button type="button" name="submit_1" onclick="updateHiddenInputs_1(), submitForm('form_1', 'toiminta_1')">Muokkaa</button>
                </form><br>
            </div><br>
            <!-- Display content -->
            <div class="w3-card-4 w3-container w3-white">
                <div class="w3-container">
                    <span id="toiminta_1">
                        <?php
                        $sql1 = "SELECT tietoa FROM etusivu";
                        $result= $conn->query($sql1);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo $row["tietoa"];
                            }
                        }
                        ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Section 2: Toiminta -->
        <div class="sections" id="toiminta_1" style="display:none;">
            <div class="w3-card-4 w3-white">
                <div class="w3-container w3-green">
                    <h2>Tietoa toiminnasta</h2>
                </div>
                
                <form method="POST" class="w3-container"  id="form_2">
                    <h3>Teksti</h3>
                    <p><div id="editor_2" name="tietoatoiminta_1">
                        <?php
                        $sql2 = "SELECT tietoa_1 FROM toiminta";
                        $result= $conn->query($sql2);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo $row["tietoa_1"];
                            }
                        }
                        ?>
                    </div></p>
                    <!--- Inputs -->
                    <input type="hidden" name="tietoatoiminta_1" id="tietoatoiminta-input_1">
                    <button type="button" name="submit_2" onclick="updateHiddenInputs_2(), submitForm('form_2', 'toiminta_2')">Muokkaa</button>
                </form><br>
            </div><br>
            <!--- Display Content -->
            <div class="w3-card-4 w3-container w3-white">
                <span id="toiminta_2">
                    <?php
                    $sql2 = "SELECT tietoa_1 FROM toiminta";
                    $result= $conn->query($sql2);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo $row["tietoa_1"];
                        }
                    }
                    ?>
                </span>
            </div>
        </div>

        <!-- Section 3: Tapahtumakalenteri -->
        <div class="sections w3-card-4 w3-white" id="tapahtumakalenteri_1" style="display:none;">
            <div class="w3-container w3-green" id="kalenteri">
                <h2>Tapahtumakalenteri</h2>
            </div>

            <form method="POST" class="w3-container" id="searchForm_1" style="display:flex; position: relative; flex-direction: column; max-width: 100%; margin: 2%; justify-content: center; align-items: center;">
                <input
                    type="text"
                    id="searchInput_2"
                    oninput='searchEvents(event)'
                    name="searchInput_2"
                    placeholder="Hae tapahtumia"
                    style="display:flex; position: relative; width: 100%;"
                    />
                <input type="hidden" id="submitButton" name="submitButton">
                <div style="display:flex; position: relative; flex-direction: column; width: 100%; align-items: center;">
                    <div class="w3-bar-block w3-white w3-card" style="display:flex; position: absolute; flex-direction: column; align-item: center; justify-content:center; z-index:5; margin-left: 2%; margin-right: 2%; width:100%;" id="searchResultsContainer"></div>
                </div>
            </form>

            <?php
            echo' <div id="searchResults" class="w3-container">';
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
                    echo '<p><input type="submit" name="updateEvent" onclick="updateHiddenInput__' . $row['id'] . '(); " value="Päivitä">';
                    echo '<input type="hidden" name="newDescription__' . $row['id'] . '" id="newDescription__' . $row['id'] . '">
                    <form method="POST" class="w3-container" id="clearEventForm">
                    <input type="submit" name="clearEvents" id="clearEvents" value="Lisää uusi">
                    </form></p></form></div>';
                            
                    echo '<script>var quill__' . $row['id'] . ' = new Quill("#editor__' . $row['id'] . '", { theme: "snow", name: "newDescription__' . $row['id'] . '" });
                        
                            console.log(document.getElementById("newDescription__' . $row['id'] . '").value);
                            function updateHiddenInput__' . $row['id'] . '() {
                                var quillContent = quill__' . $row['id'] . '.root.innerHTML;
                                console.log(quillContent);
                                        

                                document.getElementById("newDescription__' . $row['id'] . '").value = quillContent;
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
            ?>
            <br>
        </div></div><br><br>

        <!-- Section 4: Kuvagalleria -->
        <div class="w3-card-4" style="display:none;">
        </div>
    </div>

    <!-- Include JavaScript -->

    <script type="text/javascript" src="../static/scripts/animation.js"></script>
    <script type="text/javascript" src="scripts/quill.js"></script>
    <script type="text/javascript" src="../static/scripts/navigationbar.js"></script>
    <script type="text/javascript" src="../static/scripts/sidebar.js"></script>


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
    console.log(selectedOption);
    var selectedEventId = selectedOption.getAttribute('data-event-id');
    var selectedEventValue = selectedOption.getAttribute('name');
    var form = document.getElementById('searchForm_1');

    console.log('Selected Event ID:', selectedEventId);
    console.log(selectedEventValue);

    document.getElementById('searchInput_2').value = selectedEventValue;
    localStorage.setItem('selectedEventId', selectedEventId);
    document.getElementById('submitButton').value = selectedEventId;

    localStorage.setItem('containerId', document.getElementById("tapahtumakalenteri_1").getAttribute('id'));

    form.submit();
}



function updateSearchResults(results) {
    var searchResultsContainer = document.getElementById('searchResultsContainer');
    searchResultsContainer.innerHTML = '';

    for (var i = 0; i < results.length; i++) {
        var resultItem = document.createElement('div');
        resultItem.innerHTML = '<div style="text-align: center;" class="scrollpos w3-bar-item w3-button" onclick="selectEvent(this)" name="' + results[i].otsikko + '" data-event-id="' + results[i].id + '">' + results[i].otsikko + '</div>';

        searchResultsContainer.appendChild(resultItem);
    }
}


function searchEvents(event) {
  
    var input = document.getElementById('searchInput_2').value;
    console.log(input + "hello");
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
<script type="text/javascript" src="scripts/dynamicSubmit.js"></script>
<script type="text/javascript" src="scripts/logout.js"></script>




</body>
</html>
