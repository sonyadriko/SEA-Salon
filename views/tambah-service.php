<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Service - Yuvela Salon</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="content" id="content">
        <div class="main-content">
            <div class="card">
                <div class="card-body">
                    <h2>Tambah Service</h2>
                    <form action="proses_tambah_service.php" method="POST">
                        <div class="form-group">
                            <label for="branch_id">Pilih Cabang</label>
                            <select class="form-control" id="branch_id" name="branch_id" required>
                                <option value="">Pilih Cabang</option>
                                <?php
                                include '../config/database.php';
                                $get_branches = mysqli_query($conn, "SELECT * FROM branch WHERE deleted_at IS NULL");
                                while ($branch = mysqli_fetch_array($get_branches)) {
                                    echo "<option value='" . $branch['id_branch'] . "'>" . $branch['branch_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="service_name">Nama Layanan</label>
                            <input type="text" class="form-control" id="service_name" name="service_name" required>
                        </div>
                        <div class="form-group">
                            <label for="duration">Durasi (menit)</label>
                            <input type="number" class="form-control" id="duration" name="duration" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Service</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/scripts.js"></script>

</body>

</html>