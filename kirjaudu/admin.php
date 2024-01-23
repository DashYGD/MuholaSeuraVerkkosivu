<?php
$updateSuccess = false;

session_start();
include "../static/server/connect.php";

if (isset($_SESSION['muhola_admin'])) {


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateEvent'])) {
        if (isset($_POST['scrollPosition'])) {
            $_SESSION['scrollPosition'] = $_POST['scrollPosition'];
        }

        setcookie('scrollPosition', $_SESSION['scrollPosition'], time() + 3600, '/');
        $eventId = $_POST['eventId'];
        $newDate = $_POST['newDate'];
        $newTitle = $_POST['newTitle'];
        $newDescription = $_POST['newDescription__' . $eventId];
    
        $sql = "UPDATE tapahtumakalenteri SET päivä = ?, otsikko = ?, tietoa = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
    
        if ($stmt === false) {
            die('Error in preparing the SQL statement: ' . mysqli_error($conn));
        }
    
        mysqli_stmt_bind_param($stmt, "sssi", $newDate, $newTitle, $newDescription, $eventId);
        
        $result = mysqli_stmt_execute($stmt);
    
        if ($result === false) {
            die('Error in executing the SQL statement: ' . mysqli_stmt_error($stmt));
        }
    
        $affected_rows = mysqli_stmt_affected_rows($stmt);
    
        if ($affected_rows > 0) {
            echo "Update successful";
        } else {
            echo "No rows updated";
        }
    
        mysqli_stmt_close($stmt);
    }
    
    if (isset($_POST['submitButton'])) {
        $searchInput = $_POST['searchInput_2'];
    
        $selectSql = "SELECT * FROM tapahtumakalenteri WHERE otsikko LIKE ?";
        $selectStmt = mysqli_prepare($conn, $selectSql);
    
        if ($selectStmt === false) {
            die('Error in preparing the SQL statement: ' . mysqli_error($conn));
        }
    
        $searchInput = '%' . $searchInput . '%';
        mysqli_stmt_bind_param($selectStmt, "s", $searchInput);
    
        $result = mysqli_stmt_execute($selectStmt);
    
        if ($result === false) {
            die('Error in executing the SQL statement: ' . mysqli_stmt_error($selectStmt));
        }
    
        $events = mysqli_stmt_get_result($selectStmt);
    
        mysqli_stmt_close($selectStmt);
    }






    if (isset($_POST['submit_1'])) {
        if (isset($_POST['scrollPosition'])) {
            $_SESSION['scrollPosition'] = $_POST['scrollPosition'];
        }

        setcookie('scrollPosition', $_SESSION['scrollPosition'], time() + 3600, '/');
        $tietoameista = $_POST['tietoameista_1'];

        $sql1 = "UPDATE etusivu SET tietoa = '$tietoameista'";
        $result1 = mysqli_query($conn, $sql1);

        $updateSuccess = ($result1);

        if ($updateSuccess) {
            header('Location: admin');
            exit();
        }
    }

    if (isset($_POST['submit_2'])) {
        if (isset($_POST['scrollPosition'])) {
            $_SESSION['scrollPosition'] = $_POST['scrollPosition'];
        }

        setcookie('scrollPosition', $_SESSION['scrollPosition'], time() + 3600, '/');

        $tietoatoiminta = $_POST['tietoatoiminta_1'];

        $sql2 = "UPDATE toiminta SET tietoa_1 = '$tietoatoiminta'";
        $result2 = mysqli_query($conn, $sql2);

        $updateSuccess = ($result2);

        if ($updateSuccess) {
            header('Location: admin');
            exit();
        }
    }

    echo '<!DOCTYPE html>
    <html>
    <title>Admin page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-beta.0/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-beta.0/dist/quill.js"></script>

    <link rel="stylesheet" href="styles/styles.css">
    <body id="base" style="opacity:0;">';

    echo '<div class="w3-container">
    <h2>Muokkaa verkkosivun sisältöä</h2>
    ';

    echo '
    <div class="w3-card-4"  style="border-style: outset;">
    <div class="w3-container w3-green">
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

    <input type="hidden" name="scrollPosition" id="scrollPosition" value="<?php echo $scrollPosition; ?>">

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
    <div class="w3-card-4"  style="border-style: outset;">
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
    
    $scrollPosition = isset($_SESSION['scrollPosition']) ? (int)$_SESSION['scrollPosition'] : 0;

    echo '<input type="hidden" name="scrollPosition" id="scrollPosition" value="' . $scrollPosition . '">';

    unset($_SESSION['scrollPosition']);

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
    <div class="w3-card-4" style="border-style: outset;">
  <div class="w3-container w3-green">
    <h2>Tapahtumakalenteri</h2>
  </div>





  <form method="POST" class="w3-container" id="searchForm">
  <p>
  <input
    type="text"
    id="searchInput_2"
    name="searchInput_2"
    placeholder="Search events"
  />
  <button type="submit" id="submitButton" name="submitButton">Select</button>
  </p>

<div id="searchResults">';
        if (isset($events)) {
            while ($row = mysqli_fetch_assoc($events)) {
                echo '<div><p>';
                echo '<form method="POST">';
                echo '<input type="hidden" name="eventId" value="' . $row['id'] . '">';
                echo '<label>Date:</label>';
                echo '<input type="text" name="newDate" value="' . $row['päivä'] . '"><br>';
                echo '<label>Title:</label>';
                echo '<input type="text" name="newTitle" value="' . $row['otsikko'] . '"><br>';
                echo '<br><label>Description:</label><br>';
                echo '<div id="editor__' . $row['id'] . '" style="max-height: 150px;">' . $row['tietoa'] . ' </div>';
                echo '<p><input type="submit" name="updateEvent" onclick="updateHiddenInput__' . $row["id"] . '(); " value="Update"></p>';
                echo '<input type="hidden" name="newDescription__' . $row["id"] . '" id="newDescription__' . $row["id"] . '">';
                
                echo '<script>var quill__' . $row['id'] . ' = new Quill("#editor__' . $row['id'] . '", { theme: "snow", name: "newDescription__' . $row["id"] . '" });
                
                        console.log(document.getElementById("newDescription__' . $row["id"] . '").value);
                        function updateHiddenInput__' . $row["id"] . '() {
                            var quillContent = quill__' . $row['id'] . '.root.innerHTML;
                            console.log(quillContent);
                            console.log(' . $row["id"] . ');
                            

                            document.getElementById("newDescription__' . $row["id"] . '").value = quillContent;
                        }
                    </script>';

                $scrollPosition = isset($_SESSION['scrollPosition']) ? (int)$_SESSION['scrollPosition'] : 0;

                echo '<input type="hidden" name="scrollPosition" id="scrollPosition" value="' . $scrollPosition . '">';
                unset($_SESSION['scrollPosition']);
                echo '</form>';
                echo '</p></div>';
            }
        } echo '
    </div>
</form>




    <br>
    </div></div> </div>';

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

    
    <script type="text/javascript" src="../static/scripts/animation.js"></script>
    <script type="text/javascript" src="scripts/scrollposition.js"></script> 
    <script type="text/javascript" src="scripts/quill.js"></script>';
    





echo <<<EOL
<script>
var form=document.getElementById("searchForm");


document.getElementById('searchForm').addEventListener('keydown', function (event) {
if (event.key === 'Enter') {
event.preventDefault(); // Prevent the default form submission
}
});
</script>
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