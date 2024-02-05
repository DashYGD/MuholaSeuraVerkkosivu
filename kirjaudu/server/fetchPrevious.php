<?php
include "../../static/server/connect.php";

$response = array();

$sql_1 = "SELECT kuva_otsikko, kuva, kuva_tietoa
          FROM kuvagalleria
          ORDER BY id DESC
          LIMIT 1";

$result_1 = mysqli_query($conn, $sql_1);

if ($result_1 && mysqli_num_rows($result_1) > 0) {
    $row_1 = mysqli_fetch_assoc($result_1);
    
    $response['kuvagalleria'] = $row_1;
} else {
    $response['kuvagalleria'] = array('error' => 'No rows found or an error occurred.');
}

$sql_2 = "SELECT päivä, otsikko, tietoa
          FROM tapahtumakalenteri
          ORDER BY id DESC
          LIMIT 1";

$result_2 = mysqli_query($conn, $sql_2);

if ($result_2 && mysqli_num_rows($result_2) > 0) {
    $row_2 = mysqli_fetch_assoc($result_2);
    
    $response['tapahtumakalenteri'] = $row_2;
} else {
    $response['tapahtumakalenteri'] = array('error' => 'No rows found or an error occurred.');
}

echo json_encode($response);

mysqli_close($conn);