<?php
include "../../static/server/connect.php";

if (isset($_POST['quillContent']) && isset($_POST['eventId'])) {
    $quillContent = $_POST['quillContent'];
    $eventId = $_POST['eventId'];

    $sql = "UPDATE tapahtumakalenteri SET tietoa = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        die('Error in preparing the SQL statement: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "si", $quillContent, $eventId);

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
} else {
    echo "Invalid parameters";
}