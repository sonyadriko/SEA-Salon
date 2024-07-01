<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <?php
    

    // Ambil data pengguna dari database berdasarkan id_users dalam sesi
    include '../config/database.php';
    $id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT nama, email, phone_number FROM users WHERE id_users = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($name, $email, $phone);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    ?>

    <div class="content" id="content">
        <div class="main-content">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Profile</h2>
                    <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name"
                                value="<?php echo htmlspecialchars($name); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email"
                                value="<?php echo htmlspecialchars($email); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone"
                                value="<?php echo htmlspecialchars($phone); ?>" readonly>
                        </div>
                        <a href="edit-profile.php" class="btn btn-primary">Edit Profile</a>
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