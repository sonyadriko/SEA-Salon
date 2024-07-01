<?php
// Include koneksi ke database
include '../config/database.php';

// Pastikan ada input branch_id yang diterima dari AJAX
if (isset($_POST['branch_id'])) {
    $branch_id = $_POST['branch_id'];

    // Query untuk mengambil layanan berdasarkan branch_id
    $query = "SELECT * FROM service WHERE branch_id = $branch_id AND deleted_at IS NULL";
    $result = mysqli_query($conn, $query);

    // Jika query berhasil dieksekusi
    if ($result) {
        $services = array();

        // Loop untuk mengambil data layanan
        while ($row = mysqli_fetch_assoc($result)) {
            $services[] = array(
                'id_service' => $row['id_service'],
                'service_name' => $row['service_name']
            );
        }

        // Mengirimkan data dalam format JSON
        echo json_encode($services);
    } else {
        // Jika query gagal dieksekusi
        echo json_encode(array('error' => 'Query error'));
    }
} else {
    // Jika branch_id tidak diterima dari AJAX
    echo json_encode(array('error' => 'No branch_id received'));
}
?>