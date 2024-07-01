<?php
include 'database.php';

// Proses menghapus layanan jika tombol Hapus ditekan
if (isset($_POST['delete_id']) && !empty($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Pastikan untuk membersihkan input atau menggunakan parameter binding
    $delete_id = mysqli_real_escape_string($conn, $delete_id);

    // Contoh query PHP untuk menandai layanan sebagai dihapus
    $delete_query = "UPDATE service SET deleted_at = NOW() WHERE id_service = $delete_id";

    if (mysqli_query($conn, $delete_query)) {
        echo json_encode(array('success' => true, 'message' => 'Service deleted successfully.'));
        exit;
    } else {
        echo json_encode(array('success' => false, 'message' => 'Failed to delete service: ' . mysqli_error($conn)));
        exit;
    }
}
?>