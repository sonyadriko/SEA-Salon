<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Reservasi - Yuvela Salon</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="content" id="content">
        <div class="main-content">
            <div class="card">
                <div class="card-body">
                    <h2>Tambah Reservasi</h2>
                    <form action="proses_tambah_reservasi.php" method="POST">
                        <div class="form-group">
                            <label for="service">Pilih Layanan</label>
                            <select class="form-control" id="service" name="service" required>
                                <option value="">Pilih Layanan</option>
                                <option value="Haircuts and Styling">Haircuts and Styling</option>
                                <option value="Manicure and Pedicure">Manicure and Pedicure</option>
                                <option value="Facial Treatments">Facial Treatments</option>
                                <!-- Tambahkan opsi layanan lain sesuai kebutuhan -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Tanggal Reservasi</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="time">Waktu Reservasi</label>
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Reservasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
</body>

</html>