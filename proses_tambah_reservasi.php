<?php
session_start();
include 'database.php';

// Pastikan user telah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Ambil data dari form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service = $_POST['service'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $user_id = $_SESSION['user_id'];

    // Lakukan validasi atau manipulasi data sesuai kebutuhan
    // Misalnya, validasi tanggal dan waktu, atau manipulasi format

    // Simpan reservasi ke dalam database
    $stmt = $conn->prepare("INSERT INTO reservations (users_id, service_type, reservation_date, reservation_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $user_id, $service, $date, $time);

    if ($stmt->execute()) {
        // Redirect ke halaman dengan pesan sukses atau tampilkan pesan sukses di halaman ini
        header('Location: reservasi.php');
        exit();
    } else {
        // Jika gagal, tampilkan pesan error atau lakukan penanganan error
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Jika bukan metode POST, redirect atau lakukan penanganan sesuai kebutuhan
    header('Location: tambah_reservasi.php');
    exit();
}
?>