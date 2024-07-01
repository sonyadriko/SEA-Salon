<?php
include '../config/database.php';

// Proses menghapus layanan jika tombol Hapus ditekan
if (isset($_POST['delete_id']) && !empty($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Pastikan untuk membersihkan input atau menggunakan parameter binding
    $delete_id = mysqli_real_escape_string($conn, $delete_id);

    // Contoh query PHP untuk menandai layanan sebagai dihapus
    $delete_query = "UPDATE branch SET deleted_at = NOW() WHERE id_branch = $delete_id";

    if (mysqli_query($conn, $delete_query)) {
        echo json_encode(array('success' => true, 'message' => 'Branch deleted successfully.'));
        exit;
    } else {
        echo json_encode(array('success' => false, 'message' => 'Failed to delete branch: ' . mysqli_error($conn)));
        exit;
    }
}
?>