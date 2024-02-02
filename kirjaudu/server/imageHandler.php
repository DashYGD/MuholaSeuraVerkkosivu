<?php

if(isset($_POST['updateImage'])) {
    include "../static/server/connect.php";
    $imageId = $_POST['imageId'];
    $newImg = $_FILES['newImage'];

    $selectSql = "SELECT kuva FROM kuvagalleria WHERE id = ?";
    $selectStmt = mysqli_prepare($conn, $selectSql);
    if ($selectStmt === false) {
        die('Error in preparing the SQL statement: ' . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($selectStmt, "i", $imageId);
    $result = mysqli_stmt_execute($selectStmt);
    if ($result === false) {
        die('Error in executing the SQL statement: ' . mysqli_stmt_error($selectStmt));
    }
    mysqli_stmt_store_result($selectStmt);
    mysqli_stmt_bind_result($selectStmt, $existingImagePath);
    mysqli_stmt_fetch($selectStmt);

    if (!empty($newImg['name'])) {
        $fileName = $newImg['name'];
        $fileTmpName = $newImg['tmp_name'];
        $fileSize = $newImg['size'];
        $fileError = $newImg['error'];
        $fileType = $newImg['type'];

        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowed = array('jpg', 'png', 'jpeg');

        if (in_array($fileExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 50000000) {
                    $fileNameNew = uniqid('', true) . "." . $fileExt;
                    $fileDestination = '../static/images/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    // Delete the previous image file
                    unlink($existingImagePath);
                } else {
                    echo "Tiedosto on liian iso.";
                }
            } else {
                echo "Tapahtui virhe";
            }
        } else {
            echo "Väärän tyyppinen tiedosto";
        }
    } else {
        $fileDestination = $existingImagePath;
    }

    $newTitle = $_POST['newTitle'];
    $newDescription = $_POST['newDescription'];

    $sql = "UPDATE kuvagalleria SET kuva = ?, kuva_otsikko = ?, kuva_tietoa = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        die('Error in preparing the SQL statement: ' . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "sssi", $fileDestination, $newTitle, $newDescription, $imageId);
    $result = mysqli_stmt_execute($stmt);
    if ($result === false) {
        die('Error in executing the SQL statement: ' . mysqli_stmt_error($stmt));
    }
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    if ($affected_rows > 0) {
        echo "Update successful";
    } else {
        //echo "No rows updated";
    }
    mysqli_stmt_close($stmt);
}


if (isset($_POST['addImage'])) {
    include "../static/server/connect.php";
    $file = $_FILES['newImage'];
    $newImg = $_FILES['newImage']['name'];
    $fileTmpName = $_FILES['newImage']['tmp_name'];
    $fileSize = $_FILES['newImage']['size'];
    $fileError = $_FILES['newImage']['error'];
    $fileType = $_FILES['newImage']['type'];

    $fileExt = pathinfo($newImg, PATHINFO_EXTENSION);
    $allowed = array('jpg', 'png', 'jpeg');

    $kuva_otsikko = mysqli_real_escape_string($conn, $_POST["newTitle"]);
    $kuva_tietoa = mysqli_real_escape_string($conn, $_POST["newDescription"]);

    if (in_array($fileExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 50000000) {
                $newImgNew = uniqid('', true) . "." . $fileExt;
                $fileDestination = '../static/images/' . $newImgNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                
                $sql = "INSERT INTO kuvagalleria (kuva_otsikko, kuva, kuva_tietoa) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "sss", $kuva_otsikko, $fileDestination, $kuva_tietoa);
                mysqli_stmt_execute($stmt);
                
                echo "onnistui";
            } else {
                echo "Tiedosto on liian iso.";
            }
        } else {
            echo "Tapahtui virhe";
        }
    } else {
        echo "Väärän tyyppinen tiedosto";
    }
    header("Location: admin");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST['updateImage']) || isset($_POST['submitButton_2']))) {
    include "../static/server/connect.php";
    if (isset($_POST['updateImage'])) {
        $searchInput = $_POST['imageId'];
    }
    if (isset($_POST['submitButton_2'])) {
        $searchInput = $_POST['submitButton_2'];
    }
    $selectSql = "SELECT * FROM kuvagalleria WHERE id = ?";
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
    $images = mysqli_stmt_get_result($selectStmt);
    echo "<script>console.log(" . json_encode($images) . ");</script>";
    if ($images === false) {
        die('Error in getting result set: ' . mysqli_stmt_error($selectStmt));
    }
    mysqli_stmt_close($selectStmt);
}