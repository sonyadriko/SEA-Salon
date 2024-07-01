<?php
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $branch_name = $_POST['branch_name'];
    $location = $_POST['location'];
    $opening_time = $_POST['opening_time'];
    $closing_time = $_POST['closing_time'];

    $stmt = $conn->prepare("INSERT INTO branch (branch_name, location, opening_time, closing_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $branch_name, $location, $opening_time, $closing_time);

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
    <title>Tambah Cabang - Yuvela Salon</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="content" id="content">
        <div class="main-content container-fluid">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Tambah Cabang Baru</h2>
                    <?php if (isset($error_message)) { ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php } ?>
                    <form action="tambah-branch.php" method="POST">
                        <div class="form-group">
                            <label for="branch_name">Nama Cabang</label>
                            <input type="text" class="form-control" id="branch_name" name="branch_name"
                                placeholder="Masukkan nama cabang" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Lokasi</label>
                            <input type="text" class="form-control" id="location" name="location"
                                placeholder="Masukkan lokasi cabang" required>
                        </div>
                        <div class="form-group">
                            <label for="opening_time">Jam Buka</label>
                            <input type="time" class="form-control" id="opening_time" name="opening_time"
                                placeholder="Masukkan jam buka" required>
                        </div>
                        <div class="form-group">
                            <label for="closing_time">Jam Tutup</label>
                            <input type="time" class="form-control" id="closing_time" name="closing_time"
                                placeholder="Masukkan jam tutup" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Cabang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/scripts.js"></script>
</body>

</html>