<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $star_rating = $_POST['star_rating'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("INSERT INTO reviews (customer_name, star_rating, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $customer_name, $star_rating, $comment);

    if ($stmt->execute()) {
        echo "Review submitted!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>