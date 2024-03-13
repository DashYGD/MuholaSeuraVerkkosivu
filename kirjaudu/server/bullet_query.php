<?php
include "../../static/server/connect.php";

$query = mysqli_real_escape_string($conn, $_GET['query']);

$sqlSearch = "SELECT * FROM tiedotteet WHERE otsikko LIKE '%$query%'";
$resultSearch = $conn->query($sqlSearch);

$results = array();

while ($rowSearch = $resultSearch->fetch_assoc()) {
  $results[] = $rowSearch;
}

echo json_encode($results);