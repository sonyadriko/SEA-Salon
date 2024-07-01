<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi - Yuvela Salon</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <?php if($_SESSION['role'] == 'customer'){ ?>
    <div class="content" id="content">
        <div class="main-content">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Reservasi</div>
                    <a href="tambah-reservasi.php" class="btn btn-success mb-3">Make a New Reservation</a>
                    <table id="reservationTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Service</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            include 'database.php';
                            $no = 1;
                            $get_data = mysqli_query($conn, "SELECT *
                            FROM reservations
                            INNER JOIN service ON reservations.service_type = service.id_service WHERE reservations.users_id = '$_SESSION[user_id]'");

                            while($display = mysqli_fetch_array($get_data)) {
                                $id = $display['id_reservation'];
                                $name = $display['users_id'];                                            
                                $service_type = $display['service_type'];
                                $service_name = $display['service_name'];
                                $date = $display['reservation_date'];
                                $time = $display['reservation_time'];
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $time; ?></td>
                                <td><?php echo $service_name; ?></td>
                                <!-- <td>
                                    <div class="action-buttons">
                                        <a href='ubah_kuesioner.php?GetID=<?php echo $id; ?>'
                                            class="btn btn-primary btn-user">Ubah</a>
                                        <button class="btn btn-danger btn-user delete-btn"
                                            data-id="<?php echo $id; ?>">Hapus</button>
                                    </div>
                                </td> -->
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
    <?php } else if($_SESSION['role'] == 'admin'){ ?>
    <div class="content" id="content">
        <div class="main-content">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Reservasi</div>
                    <table id="reservationTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Service</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            include 'database.php';
                            $no = 1;
                            $get_data = mysqli_query($conn, "SELECT *
                            FROM reservations
                            INNER JOIN service ON reservations.service_type = service.id_service INNER JOIN users ON reservations.users_id = users.id_users");
                            while($display = mysqli_fetch_array($get_data)) {
                                $id = $display['id_reservation'];
                                $name = $display['nama'];                                            
                                $service_type = $display['service_type'];
                                $service_name = $display['service_name'];
                                $date = $display['reservation_date'];
                                $time = $display['reservation_time'];
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $time; ?></td>
                                <td><?php echo $service_name; ?></td>
                                <!-- <td>
                                    <div class="action-buttons">
                                        <a href='ubah_kuesioner.php?GetID=<?php echo $id; ?>'
                                            class="btn btn-primary btn-user">Ubah</a>
                                        <button class="btn btn-danger btn-user delete-btn"
                                            data-id="<?php echo $id; ?>">Hapus</button>
                                    </div>
                                </td> -->
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
    <?php } ?>

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
</body>

</html>