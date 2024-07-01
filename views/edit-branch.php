<?php
include '../config/database.php';

// Pastikan ID cabang dikirimkan melalui parameter GET
if (!isset($_GET['branch_id'])) {
    header('Location: branch.php');
    exit();
}

$branch_id = $_GET['branch_id'];

// Ambil data cabang dari database berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM branch WHERE id_branch = ?");
$stmt->bind_param("i", $branch_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Cabang tidak ditemukan.";
    exit();
}

$branch = $result->fetch_assoc();

// Tangkap data dari form jika ada POST request untuk menyimpan perubahan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_cabang = $_POST['nama_cabang'];
    $lokasi = $_POST['lokasi'];
    $jam_buka = $_POST['jam_buka'];
    $jam_tutup = $_POST['jam_tutup'];

    // Update data cabang ke database
    $stmt = $conn->prepare("UPDATE branch SET branch_name = ?, location = ?, opening_time = ?, closing_time = ? WHERE id_branch = ?");
    $stmt->bind_param("sssii", $nama_cabang, $lokasi, $jam_buka, $jam_tutup, $branch_id);

    if ($stmt->execute()) {
        header("Location: branch.php");
        exit();
    } else {
        $error_message = "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Branch - Yuvela Salon</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="content" id="content">
        <div class="main-content container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Edit Branch</div>
                    <?php if (isset($error_message)) { ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php } ?>
                    <form action="edit-branch.php?branch_id=<?php echo $branch_id; ?>" method="POST">
                        <div class="form-group">
                            <label for="nama_cabang">Branch Name</label>
                            <input type="text" class="form-control" id="nama_cabang" name="nama_cabang"
                                value="<?php echo $branch['branch_name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Location</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi"
                                value="<?php echo $branch['location']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="jam_buka">Opening Time (24-hour format)</label>
                            <input type="number" class="form-control" id="jam_buka" name="jam_buka"
                                value="<?php echo $branch['opening_time']; ?>" min="1" max="24" required>
                        </div>
                        <div class="form-group">
                            <label for="jam_tutup">Closing Time (24-hour format)</label>
                            <input type="number" class="form-control" id="jam_tutup" name="jam_tutup"
                                value="<?php echo $branch['closing_time']; ?>" min="1" max="24" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Branch</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/scripts.js"></script>
</body>

</html>