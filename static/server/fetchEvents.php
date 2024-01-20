<?php
include "connect.php";

$sql = "SELECT * FROM tapahtumakalenteri ORDER BY päivä";
$result = $conn->query($sql);

$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = [
        'title' => $row['otsikko'],
        'date' => $row['päivä'], // Assuming 'päivä' is in the format 'YYYY-MM-DD'
        'description' => $row['tietoa']
    ];
}

header('Content-Type: application/json');
echo json_encode($events);