<?php
session_start();
include("connect.php");
if (!isset($_SESSION['name']))
    header('location:login.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Management System | Home </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
    <link rel="stylesheet" href="font.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        .hero-section {
            height: 100vh;
            background: linear-gradient(rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1)), url('images/bus_banner.jpg') no-repeat center center/cover;
        }

        .btn {
            background-color: #2b4eda;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 17px;
            margin: 10px;
            cursor: pointer;
            border-radius: 7px;
            transition: background-color 0.2s ease;
            height: 52px;
            aspect-ratio: 3;
        }

        .btn:hover {
            background-color: #ff0505;
        }


        .logo {
            width: 50px;
        }

        .login-btn {
            padding: 10px 20px;
            text-align: center;
            background-color: green;
            border: none;
            color: white;
            border-radius: 10px;
            font-size: 17px;
        }

        .login-btn:hover {
            background-color: rgba(0, 255, 0, 0.6);
        }

        .book-btn {
            background-color: rgba(51, 67, 87, 0.9);
        }

        .book-btn:hover {
            background-color: rgba(51, 67, 87, 1);
            color: white;
        }
        @media (max-width: 600px) {
            .btn {
                padding: 12px 24px;
                font-size: 14px;
            }
        }
        body,
        h1,
        h2,
        p {
            margin: 0;
            padding: 0;
            font-family: 'Roboto';
        }

        body {
            background-color: #FBF8F2;
            color: #333;
            line-height: 1.6;
        }

        header {
            background: #0056b3;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }

        .navbar {
            background-color: #334257;
            color: white;
            backdrop-filter: blur(2px);
        }

        nav a:not(.active) {
            color: white;
        }

        nav a {
            position: relative;
        }

        nav a::before:not(.logo) {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            background-color: white;
            width: 100%;
            height: 2px;
            visibility: hidden;
            opacity: 0;
            transition: all 0.4s ease-in-out;
        }

        nav a:hover::before {
            visibility: visible;
            opacity: 1;
            bottom: -3px;
        }

        .navbar-nav:hover {
            color: white;
        }


        .nav-link:focus,
        .nav-link:hover {
            color: white;
        }

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link.show {
            color: #009900;
        }

        .intro {
            padding: 2rem;
            text-align: center;
        }

        .intro h2 {
            margin-bottom: 1rem;
            font-size: 2rem;
        }

        .intro p {
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .gallery {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            padding: 2rem;
            gap: 1rem;
        }

        .bus-image {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .bus-image img {
            width: 100%;
            height: auto;
        }

        .bus-image p {
            padding: 0.5rem;
            background: #f4f4f4;
            margin: 0;
        }

        .features,
        .testimonials {
            padding: 2rem;
            text-align: center;
        }

        .features h2,
        .testimonials h2 {
            margin-bottom: 1rem;
            font-size: 2rem;
        }

        .features p,
        .testimonials p {
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .features ul {
            list-style: none;
            padding: 0;
            margin: 1rem 0;
        }

        .features li {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            margin: 0.5rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .cta {
            background: #0056b3;
            color: #fff;
            padding: 2rem;
            text-align: center;
        }

        .cta h2 {
            margin-bottom: 1rem;
            font-size: 2rem;
        }

        .cta p {
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto;
            margin-bottom: 2rem;
        }

        .cta button {
            background: #fff;
            color: #0056b3;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        .cta button:hover {
            background: #e0e0e0;
        }

        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 1rem;
            width: 100%;
            bottom: 0;
        }

        .header {
            box-shadow: 5px 0.2px 4px rgb(15, 15, 15);
            height: 84px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg position-fixed top-0 w-100">
        <div class="container-fluid">
            <a class="navbar-brand" href="./home.php">
                <img class="logo" src="./images/bus_logo2.png" alt="logo-png">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarScroll">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar-nav-scroll">

                    <li class="nav-item">
                        <a href="home.php" class=" nav-link active fs-5">Home</a>
                    </li>

                    <li class="nav-item">
                        <a href="schedule.php" class=" nav-link fs-5">Schedule</a>
                    </li>

                    <li class="nav-item">
                        <a href="team.php" class=" nav-link fs-5">Team</a>
                    </li>


                    <li class="nav-item">
                        <a href="contact.php" class="nav-link fs-5">Contact Us</a>
                    </li>

                    <li class="nav-item">
                        <a href="My Admin Panel/index.php" class="nav-link fs-5">Admin</a>
                    </li>
                </ul>

                <?php echo $_SESSION['name']; ?><a class="btn-getstarted ms-4 login-btn text-decoration-none fs-6" href="logout.php">Logout</a>

            </div>
        </div>
    </nav>
    <section class="hero-section d-flex align-items-center justify-content-center">
        <a href="schedule.php" class="btn book-btn">Book Now</a>
    </section>
    <section class="intro">
        <h2>Efficiently Manage Your Bus Fleet</h2>
        <p>Our bus management system is designed to streamline the operation of your bus fleet. From scheduling and
            route management to maintenance tracking and reporting, our system offers everything you need to ensure
            smooth and efficient bus operations.</p>
    </section>

    <section class="gallery">
        <div class="bus-image">
            <img src="images/bus1.jpg" alt="Bus Model A">
            <p>Bus Model A - Modern and Efficient</p>
        </div>
        <div class="bus-image">
            <img src="images/bus2.jpg" alt="Bus Model B">
            <p>Bus Model B - Comfortable and Reliable</p>
        </div>
        <div class="bus-image">
            <img src="images/bus3.jpg" alt="Bus Model C">
            <p>Bus Model C - Eco-Friendly and Advanced</p>
        </div>
    </section>

    <section class="features">
        <h2>Key Features</h2>
        <p>Our system includes a range of features to help you manage your fleet effectively:</p>
        <ul>
            <li>Real-time Scheduling and Route Management</li>
            <li>Maintenance Tracking and Alerts</li>
            <li>Comprehensive Reporting and Analytics</li>
            <li>Driver and Passenger Management</li>
            <li>User-Friendly Interface and Mobile Access</li>
        </ul>
    </section>

    <section class="testimonials">
        <h2>What Our Users Say</h2>
        <p>"The bus management system has transformed the way we operate our fleet. The real-time updates and
            maintenance alerts have greatly improved our efficiency."</p>
        <p>"An intuitive and reliable solution that has made managing our bus routes and schedules much easier. Highly
            recommended!"</p>
    </section>

    <section class="cta">
        <h2>Get Started Today!</h2>
        <p>Ready to take your bus management to the next level? Contact us now to schedule a demo or request more
            information.</p>
        <button type="submit"><a class="text-decoration-none text-black fs-5" href="contact.php">Contact Us</a></button>
    </section>

    <footer>
        <p>&copy; 2024 Bus Management System. All rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>