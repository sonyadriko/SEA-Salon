<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Reservasi - Yuvela Salon</title>
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
                    <h2>Tambah Reservasi</h2>
                    <form action="proses_tambah_reservasi.php" method="POST">
                        <div class="form-group">
                            <label for="branch">Pilih Cabang</label>
                            <select class="form-control" id="branch" name="branch" required>
                                <option value="">Pilih Cabang</option>
                                <?php
                                include '../config/database.php';

                                // Ambil data cabang dari database
                                $query = "SELECT * FROM branch";
                                $result = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_array($result)) {
                                    $branch_name = $row['branch_name'];
                                    $id_branch = $row['id_branch'];
                                    echo "<option value='$id_branch'>$branch_name</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="service">Pilih Layanan</label>
                            <select class="form-control" id="service" name="service" required>
                                <option value="">Pilih Layanan</option>
                                <!-- Opsi layanan akan diisi menggunakan JavaScript setelah memilih cabang -->
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/scripts.js"></script>

    <script>
    $(document).ready(function() {
        // Fungsi untuk memuat opsi layanan berdasarkan cabang yang dipilih
        $('#branch').change(function() {
            var branch_id = $(this).val();
            $.ajax({
                url: 'get_services.php',
                type: 'post',
                data: {
                    branch_id: branch_id
                },
                dataType: 'json',
                success: function(response) {
                    var len = response.length;
                    $('#service').empty();
                    $('#service').append("<option value=''>Pilih Layanan</option>");
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id_service'];
                        var name = response[i]['service_name'];
                        $('#service').append("<option value='" + id + "'>" + name +
                            "</option>");
                    }
                }
            });
        });
    });
    </script>

</body>

</html>