<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['updateEvent'])) {
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

    if (isset($_POST['submit_1'])) {
        $tietoameista = $_POST['tietoameista_1'];
        $sql1 = "UPDATE etusivu SET tietoa = '$tietoameista'";
        $result1 = mysqli_query($conn, $sql1);
        header("Location: admin");
        exit(); // Ensure no further output is sent
    }

    if (isset($_POST['submit_2'])) {
        $tietoatoiminta = $_POST['tietoatoiminta_1'];
        $sql2 = "UPDATE toiminta SET tietoa_1 = '$tietoatoiminta'";
        $result2 = mysqli_query($conn, $sql2);
        header("Location: admin");
        exit(); // Ensure no further output is sent
    }

    if(isset($_POST['addEvent'])) {
        if(isset($_POST['newDate']) && isset($_POST['newTitle']) && isset($_POST['newDescription_1'])) {
            $newDate = $_POST['newDate'];
            $newTitle = $_POST['newTitle'];
            $newDescription = $_POST['newDescription_1'];
            $insertSql = "INSERT INTO tapahtumakalenteri (päivä, otsikko, tietoa) VALUES (?, ?, ?)";
            $insertStmt = mysqli_prepare($conn, $insertSql);
            if($insertStmt === false) {
                die('Error in preparing the SQL statement: ' . mysqli_error($conn));
            }
            mysqli_stmt_bind_param($insertStmt, "sss", $newDate, $newTitle, $newDescription);
            $result = mysqli_stmt_execute($insertStmt);
            if($result === false) {
                die('Error in executing the SQL statement: ' . mysqli_stmt_error($insertStmt));
            }
            if(mysqli_stmt_affected_rows($insertStmt) > 0) {
                echo "Event added successfully.";
            } else {
                echo "Failed to add event.";
            }
            mysqli_stmt_close($insertStmt);
        } else {
            echo "All required fields are not set.";
        }
        header("Location: admin");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST['updateEvent']) || isset($_POST['submitButton']))) {
    if (isset($_POST['updateEvent'])) {
        $searchInput = $_POST['eventId'];
    }
    if (isset($_POST['submitButton'])) {
        $searchInput = $_POST['submitButton'];
    }
    $selectSql = "SELECT * FROM tapahtumakalenteri WHERE id = ?";
    $selectStmt = mysqli_prepare($conn, $selectSql);
    if ($selectStmt === false) {
        die('Error in preparing the SQL statement: ' . mysqli_error($conn));
    }
    $searchInput = (int)$searchInput;
    mysqli_stmt_bind_param($selectStmt, "i", $searchInput);
    $result = mysqli_stmt_execute($selectStmt);
    if ($result === false) {
        die('Error in executing the SQL statement: ' . mysqli_stmt_error($selectStmt));
    }
    $events = mysqli_stmt_get_result($selectStmt);
    echo "<script>console.log(" . json_encode($events) . ");</script>";
    if ($events === false) {
        die('Error in getting result set: ' . mysqli_stmt_error($selectStmt));
    }
    mysqli_stmt_close($selectStmt);
}