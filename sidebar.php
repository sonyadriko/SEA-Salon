<?php 
session_start();
// Pastikan user telah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
} ?>
<div class="sidebar" id="sidebar">
    <div class="logo">
        <div>
            <!-- <img src="logo.png" alt="Yuvela Salon"> -->
            <h2>Yuvela Salon</h2>
        </div>
    </div>
    <a href="#"><i class="fas fa-user-circle"></i> <?php echo $_SESSION['nama'] ?></a>
    <?php if($_SESSION['role'] == 'admin'){ ?>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
    <a href="service.php"><i class="fas fa-user"></i> Service</a>
    <a href="reservasi.php"><i class="fas fa-calendar-alt"></i> Reservasi</a>
    <a href="review2.php"><i class="fas fa-star"></i> Review</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    <?php }else if($_SESSION['role'] == 'customer'){ ?>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
    <a href="reservasi.php"><i class="fas fa-calendar-alt"></i> Reservasi</a>
    <a href="review2.php"><i class="fas fa-star"></i> Review</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    <?php } ?>
</div>

<div class="toggle-btn-container" id="toggle-btn-container">
    <button class="toggle-btn" id="toggle-btn"><i class="fas fa-bars"></i></button>
</div>