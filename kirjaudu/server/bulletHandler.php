<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(isset($_POST['bulletId'])) {
        include "../../static/server/connect.php";
        $bulletId = $_POST['bulletId'];
        $newDate = $_POST['newDate'];
        $newTitle = $_POST['newTitle'];
        $newDescription = $_POST['newDescription___' . $bulletId];
        $sql = "UPDATE tiedotteet SET pvm = ?, otsikko = ?, teksti = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt === false) {
            die('Error in preparing the SQL statement: ' . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, "sssi", $newDate, $newTitle, $newDescription, $bulletId);
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

    if(isset($_POST['addBullet'])) {
        include "../static/server/connect.php";
        if(isset($_POST['newDate']) && isset($_POST['newTitle']) && isset($_POST['newDescription_0'])) {
            $newDate = $_POST['newDate'];
            $newTitle = $_POST['newTitle'];
            $newDescription = $_POST['newDescription_0'];
            $insertSql = "INSERT INTO tiedotteet (pvm, otsikko, teksti) VALUES (?, ?, ?)";
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
                //echo "Event added successfully.";
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitButton_0'])) {
    include "../static/server/connect.php";
    if (isset($_POST['bulletId'])) {
        $searchInput = $_POST['bulletId'];
    }
    if (isset($_POST['submitButton_0'])) {
        $searchInput = $_POST['submitButton_0'];
    }
    $selectSql = "SELECT * FROM tiedotteet WHERE id = ?";
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
    $bullets = mysqli_stmt_get_result($selectStmt);
    if ($bullets === false) {
        die('Error in getting result set: ' . mysqli_stmt_error($selectStmt));
    }
    mysqli_stmt_close($selectStmt);
}