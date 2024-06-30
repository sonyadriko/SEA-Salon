<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yuvela Salon</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        scroll-behavior: smooth;
    }

    .navbar-nav .nav-link {
        color: #fff !important;
    }

    .full-height-section {
        position: relative;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 50px 15px;
    }

    #home {
        background: url('image.webp') no-repeat center center/cover;
        position: relative;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #home::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        /* Black overlay with 50% opacity */
        z-index: 1;
    }

    .header {
        text-align: center;
        color: #fff;
        z-index: 2;
    }

    .services,
    .contact {
        text-align: center;
    }

    .header h1,
    .services h2,
    .contact h2 {
        font-size: 4em;
        margin-bottom: 20px;
    }

    .header p,
    .services p,
    .contact p {
        font-size: 1.5em;
    }

    .card-deck .card {
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .card img {
        transition: transform 0.3s ease-in-out;
    }

    .card-body {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .card-title {
        font-size: 1.5em;
        color: #333;
        margin-top: 15px;
    }

    .card-text {
        font-size: 1em;
    }

    .card:hover img {
        transform: scale(1.1);
    }

    .card:hover .card-body {
        opacity: 1;
    }

    .container-section {
        padding: 50px 15px;
    }

    @media (max-width: 768px) {

        .header h1,
        .services h2,
        .contact h2 {
            font-size: 2.5em;
        }

        .header p,
        .services p,
        .contact p {
            font-size: 1em;
        }

        .card-title {
            font-size: 1.2em;
        }

        .card-text {
            font-size: 0.9em;
        }
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Yuvela Salon</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="home" class="full-height-section">
        <div class="header">
            <h1>Yuvela Salon</h1>
            <p>“Beauty and Elegance Redefined”</p>
        </div>
    </div>

    <div id="services" class="full-height-section">
        <div class="services">
            <h2>Our Services</h2>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img src="service1.webp" class="card-img-top" alt="Haircuts and Styling">
                            <div class="card-body">
                                <p class="card-text">Get the latest haircuts and styles from our expert stylists.
                                    Whether you're looking for a trim or a complete makeover, we've got you covered.
                                </p>
                            </div>
                            <div class="card-title">Haircuts and Styling</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="service2.webp" class="card-img-top" alt="Manicure and Pedicure">
                            <div class="card-body">
                                <p class="card-text">Pamper yourself with our luxurious manicure and pedicure services.
                                    Our experienced technicians will ensure your nails look their best.</p>
                            </div>
                            <div class="card-title">Manicure and Pedicure</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="service3.webp" class="card-img-top" alt="Facial Treatments">
                            <div class="card-body">
                                <p class="card-text">Rejuvenate your skin with our range of facial treatments. From
                                    cleansing facials to anti-aging treatments, we have something for everyone.</p>
                            </div>
                            <div class="card-title">Facial Treatments</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="contact" class="full-height-section">
        <div class="contact">
            <h2>Contact Us</h2>
            <p><strong>Thomas</strong><br>Phone Number: 08123456789</p>
            <p><strong>Sekar</strong><br>Phone Number: 08164829372</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>