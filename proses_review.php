<?php
session_start();
include 'database.php';

$user_id = $_SESSION['user_id'];
$reservation_id = $_POST['reservation'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

// Query untuk menyimpan review ke dalam tabel reviews
$insert_review = mysqli_query($conn, "INSERT INTO reviews (users_id, reservation_id, star_rating, comment) VALUES ($user_id, $reservation_id, $rating, '$comment')");

if ($insert_review) {
    header('Location: review2.php');
    exit();
} else {
    echo "Gagal menyimpan review: " . mysqli_error($conn);
}

mysqli_close($conn);
?>