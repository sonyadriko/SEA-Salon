<?php
include 'database.php';

// Cek apakah parameter GetID ada dan valid
if (isset($_GET['GetID']) && is_numeric($_GET['GetID'])) {
    $service_id = $_GET['GetID'];

    // Query untuk mendapatkan data layanan berdasarkan ID
    $get_service = mysqli_query($conn, "SELECT * FROM service WHERE id_service = $service_id");

    if (mysqli_num_rows($get_service) == 1) {
        $service = mysqli_fetch_assoc($get_service);
    } else {
        // Redirect jika layanan tidak ditemukan
        header("Location: list_service.php");
        exit();
    }
} else {
    // Redirect jika parameter GetID tidak diberikan
    header("Location: list_service.php");
    exit();
}

// Proses update layanan jika formulir disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_name = $_POST['service_name'];
    $duration = $_POST['duration'];

    // Query untuk update data layanan
    $update_query = "UPDATE service SET service_name = '$service_name', duration = '$duration' WHERE id_service = $service_id";

    if (mysqli_query($conn, $update_query)) {
        // Redirect ke halaman list_service jika update berhasil
        header("Location: service.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Service - Yuvela Salon</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="content" id="content">
        <div class="main-content">
            <div class="card">
                <div class="card-body">
                    <h2>Ubah Service</h2>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="service_name">Nama Layanan</label>
                            <input type="text" class="form-control" id="service_name" name="service_name"
                                value="<?php echo $service['service_name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="duration">Durasi (dalam menit)</label>
                            <input type="number" class="form-control" id="duration" name="duration"
                                value="<?php echo $service['duration']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>