<?php
session_start();
include 'database.php';

// Pastikan user telah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Perbarui data pengguna di database
    $stmt = $conn->prepare("UPDATE users SET nama = ?, email = ?, phone_number = ? WHERE id_users = ?");
    $stmt->bind_param("sssi", $name, $email, $phone, $id);
    if ($stmt->execute()) {
        // Perbarui sesi dengan nilai yang baru
        $_SESSION['nama'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;

        // Redirect ke halaman profil setelah berhasil memperbarui
        header('Location: profile.php');
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
} else {
    header('Location: profile.php');
    exit();
}
?>