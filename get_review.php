<?php
include 'database.php';

$result = $conn->query("SELECT * FROM reviews");
$reviews = array();

while ($row = $result->fetch_assoc()) {
    $reviews[] = $row;
}

echo json_encode($reviews);
$conn->close();