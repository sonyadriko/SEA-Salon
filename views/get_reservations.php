<?php
include '../config/database.php';

$result = $conn->query("SELECT * FROM reservations");
$reservations = array();

while ($row = $result->fetch_assoc()) {
    $reservations[] = $row;
}

echo json_encode($reservations);
$conn->close();
?>