<?php
session_start();
include 'database.php';

header('Content-Type: application/json');

$response = array('success' => false, 'message' => 'Invalid request');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id_users, password, role, nama FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $role, $nama);
        $stmt->fetch();
        
        // Check if password is correct
        $is_password_valid = password_verify($password, $hashed_password);

        if ($is_password_valid) {
            $_SESSION['user_id'] = $id;
            $_SESSION['role'] = $role;
            $_SESSION['nama'] = $nama;
            $response['success'] = true;
            $response['message'] = 'Login successful';
        } else {
            $response['message'] = 'Invalid email or password.';
        }
    } else {
        $response['message'] = 'Invalid email or password.';
    }
    $stmt->close();
} else {
    $response['message'] = 'Request method not supported.';
}

$conn->close();

echo json_encode($response);
?>