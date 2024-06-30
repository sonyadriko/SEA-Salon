<?php
include '../config/database.php';
session_start();

header('Content-Type: application/json');

$response = array('success' => false, 'message' => 'Terjadi kesalahan saat melakukan login.');

try {
    // Pastikan metode request adalah POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Pastikan email dan password dikirimkan
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Hash the received password to match the hashed password stored in the database
            // $hashed_password = password_hash($password, PASSWORD_DEFAULT); // No need to hash here

            // Query to retrieve user data
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if a user with this email exists
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                // Verify password using password_verify
                if (password_verify($password, $row['password'])) {
                    // Set session variables
                    $_SESSION['id_users'] = $row['id_users'];
                    $_SESSION['nama'] = $row['nama'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['role'] = $row['role'];

                    $response['success'] = true;
                    $response['message'] = 'Login berhasil';
                    $response['redirect'] = 'dashboard.php'; // Set the redirect URL after successful login
                } else {
                    $response['message'] = 'Email atau Password salah';
                }
            } else {
                $response['message'] = 'Email atau Password salah';
            }

            $stmt->close();
        } else {
            $response['message'] = 'Email dan Password diperlukan';
        }
    }
} catch (Exception $e) {
    // Handle any unexpected exceptions
    $response['message'] = 'Terjadi kesalahan saat melakukan login: ' . $e->getMessage();
}

echo json_encode($response);
?>