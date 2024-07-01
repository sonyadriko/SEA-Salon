<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review - Yuvela Salon</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <?php
include '../config/database.php';

$user_id = $_SESSION['user_id']; // Ambil user_id dari session

// Query untuk mengambil daftar reservasi pengguna
$user_id = $_SESSION['user_id'];

// Query untuk mendapatkan reservasi yang belum direview oleh pengguna
$get_reservations = mysqli_query($conn, "SELECT r.id_reservation, r.reservation_date, r.reservation_time, br.branch_name, sv.service_name
                                         FROM reservations r
                                         LEFT JOIN service sv ON r.service_type = sv.id_service
                                         LEFT JOIN reviews rv ON r.id_reservation = rv.reservation_id
                                         LEFT JOIN branch br ON r.branch_id = br.id_branch
                                         WHERE r.users_id = $user_id
                                         AND rv.reservation_id IS NULL");
if (!$get_reservations) {
    die('Query Error: ' . mysqli_error($conn));
}
?>
    <?php if($_SESSION['role'] == 'customer'){ ?>
    <div class="content" id="content">
        <div class="main-content">
            <div class="card">
                <div class="card-body">
                    <h2>Review Reservasi</h2>
                    <?php if (mysqli_num_rows($get_reservations) > 0) : ?>
                    <form action="proses_review.php" method="POST">
                        <div class="form-group">
                            <label for="reservation">Pilih Reservasi untuk Direview</label>
                            <select class="form-control" id="reservation" name="reservation" required>
                                <option value="">Pilih Reservasi</option>
                                <?php while ($reservation = mysqli_fetch_assoc($get_reservations)) : ?>
                                <option value="<?php echo $reservation['id_reservation']; ?>">
                                    <?php echo $reservation['branch_name'] . ', ' . $reservation['service_name'] . ', ' . $reservation['reservation_date'] . ' ' . $reservation['reservation_time']; ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <select class="form-control" id="rating" name="rating" required>
                                <option value="">Pilih Rating</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                    <?php else : ?>
                    <p>Anda telah mereview semua reservasi yang tersedia.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php } else if($_SESSION['role'] == 'admin'){ ?>
    <div class="content" id="content">
        <div class="main-content">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Review Customer</div>
                    <div class="table-responsive">

                        <table id="reviewTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Branch Name</th>
                                    <th>Service Type</th>
                                    <th>Date, Time</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            include '../config/database.php';
                            $no = 1;
                            $get_data = mysqli_query($conn, "SELECT * FROM reviews INNER JOIN reservations ON reservations.id_reservation = reviews.reservation_id JOIN users ON users.id_users = reviews.users_id JOIN service ON reservations.service_type = service.id_service JOIN branch ON reservations.branch_id = branch.id_branch");
                            while($display = mysqli_fetch_array($get_data)) {
                                $id = $display['id'];
                                $name = $display['nama'];
                                $branch = $display['branch_name'];
                                $service = $display['service_name'];
                                $date = $display['reservation_date'];
                                $time = $display['reservation_time'];
                                $rating = $display['star_rating'];                                            
                                $comment = $display['comment'];
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $branch; ?></td>
                                    <td><?php echo $service; ?></td>
                                    <td><?php echo $date, $time; ?></td>
                                    <td><?php echo $rating; ?></td>
                                    <td><?php echo $comment; ?></td>
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
    </div>
    <?php } ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/scripts.js"></script>
    <script>
    $(document).ready(function() {
        $('#reviewTable').DataTable();
    });
    </script>
</body>

</html>