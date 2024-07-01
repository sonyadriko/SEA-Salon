<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabang - Yuvela Salon</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="content" id="content">
        <div class="main-content container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Cabang</div>
                    <a href="tambah-branch.php" class="btn btn-success mb-3">Make a New Branch</a>
                    <div class="table-responsive">
                        <table id="branchTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Branch Name</th>
                                    <th>Location</th>
                                    <th>Operational Hours</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
        include '../config/database.php';
        $no = 1;
        $get_data = mysqli_query($conn, "SELECT * FROM branch WHERE deleted_at IS NULL");
        while($display = mysqli_fetch_array($get_data)) {
            $id = $display['id_branch'];
            $name = $display['branch_name'];                                            
            $location = $display['location'];
            $opening_hour = $display['opening_time'];
            $closing_hour = $display['closing_time'];
            
            // Ubah format jam integer menjadi format jam standar
            $opening = format_operational_hour($opening_hour);
            $closing = format_operational_hour($closing_hour);
        ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $location; ?></td>
                                    <td><?php echo $opening . ' - ' . $closing; ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href='edit-branch.php?branch_id=<?php echo $id; ?>'
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
                        <?php
function format_operational_hour($hour) {
    if ($hour >= 12 && $hour <= 24) {
        $suffix = 'PM';
        if ($hour > 12) {
            $hour -= 12;
        }
    } else {
        $suffix = 'AM';
        if ($hour == 0) {
            $hour = 12;
        }
    }
    return sprintf('%02d:00 %s', $hour, $suffix);
}
?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/scripts.js"></script>

    <script>
    $(document).ready(function() {
        $('#branchTable').DataTable();
    });
    $(document).ready(function() {
        // Ajax untuk menghapus layanan
        $('.delete-btn').click(function() {
            var branch_id = $(this).data('id');
            if (confirm("Apakah Anda yakin ingin menghapus cabang ini?")) {
                $.ajax({
                    type: 'POST',
                    url: 'delete_branch.php',
                    data: {
                        delete_id: branch_id
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
                            'Terjadi kesalahan dalam menghapus branch.'
                        ); // Menampilkan pesan kesalahan kepada pengguna
                    }
                });
            }
        });
    });
    </script>

</body>

</html>