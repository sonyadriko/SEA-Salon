<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service - Yuvela Salon</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>


    <div class="content" id="content">
        <div class="main-content">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Service</div>
                    <a href="tambah-service.php" class="btn btn-success mb-3">Make a New Service Type</a>
                    <table id="reservationTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service Name</th>
                                <th>Duration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            include 'database.php';
                            $no = 1;
                            $get_data = mysqli_query($conn, "SELECT * FROM service WHERE deleted_at IS NULL");
                            while($display = mysqli_fetch_array($get_data)) {
                                $id = $display['id_service'];
                                $name = $display['service_name'];                                            
                                $duration = $display['duration'];
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $duration; ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href='ubah-service.php?GetID=<?php echo $id; ?>'
                                            class="btn btn-primary btn-user">Ubah</a>
                                        <button class="btn btn-danger btn-user delete-btn"
                                            data-id="<?php echo $id; ?>">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>

    <script>
    $(document).ready(function() {
        $('#reservationTable').DataTable();
    });
    </script>
    <script>
    $(document).ready(function() {
        // Ajax untuk menghapus layanan
        $('.delete-btn').click(function() {
            var service_id = $(this).data('id');

            if (confirm("Apakah Anda yakin ingin menghapus layanan ini?")) {
                $.ajax({
                    type: 'POST',
                    url: 'delete_service.php',
                    data: {
                        delete_id: service_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message); // Menampilkan pesan sukses
                            window.location.reload();
                        } else {
                            alert(response.message); // Menampilkan pesan gagal
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Terjadi kesalahan:",
                            error); // Memeriksa pesan kesalahan di konsol
                        alert(
                            'Terjadi kesalahan dalam menghapus layanan.'
                        ); // Menampilkan pesan kesalahan kepada pengguna
                    }
                });


            }
        });
    });
    </script>

</body>

</html>