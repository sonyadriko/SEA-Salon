<?php
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $branch_id = $_POST['branch_id'];
    $service_name = $_POST['service_name'];
    $duration = $_POST['duration'];

    // Query untuk memasukkan data baru ke dalam tabel service
    $stmt = $conn->prepare("INSERT INTO service (branch_id, service_name, duration) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $branch_id, $service_name, $duration);

    if ($stmt->execute()) {
        // Jika berhasil ditambahkan, redirect ke halaman layanan atau halaman lain
        header('Location: service.php');
        exit();
    } else {
        // Jika gagal, tampilkan pesan error atau lakukan penanganan error
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Jika bukan metode POST, redirect ke halaman tambah-service.php atau lakukan penanganan sesuai kebutuhan
    header('Location: tambah-service.php');
    exit();
}
?>