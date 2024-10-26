<?php 
session_start();
include('connection.php');
if (!isset($_SESSION['username']))
    header('location: index.php');
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">

    <style>
        .active {
            background: #1c88f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="logo">
                <h2>Menu</h2>
            </div>
                <ul>
                    <li class="active" ><a href="dashboard.php"><i class="fas fa-tv "></i> Dashboard</a></li>
                    <li><a href="view pass.php"><i class="fas fa-address-book"></i> View Pass</a></li>
                    <li><a href="routes.php"><i class="fas fa-heart"></i> Routes</a></li>
                    <li><a href="other_admin.php"><i class="fas fa-user"></i> Other Admin</a></li>
                    <li><a href="about.php"><i class="fas fa-cogs"></i> About</a></li>
                  </ul>
            </nav>

        <div class="main-content">
            <header>
                <h1>Dashboard</h1>
                <div class="toggle-btn" id="toggle-btn">&#9776;</div>
            </header>

            <section class="welcome">
                <h2>Welcome <?php echo $_SESSION['username'];?></h2>
            </section>


            <section class="cards">
                <div class="card">
                    <h3>Total Buses</h3>
                    <p>18</p>
                </div>
                <div class="card">
                    <h3>Total Routes</h3>
                    <p>50</p>
                </div>
                <div class="card">
                    <h3>Other Admin</h3>
                    <p>4</p>
                </div>
                <div class="card">
                    <h3>Total Bookings</h3>
                    <p>10</p>
                </div>
            </section>

            <section class="overview">
                <h2>System Overview</h2>
                <p>
                    Welcome to the Bus Management System Dashboard. Here, you can manage all aspects of your bus operations efficiently. 
                    Track and manage your fleet of buses, monitor routes, assign drivers, and schedule trips seamlessly. 
                    The system provides real-time updates and detailed reports to help you make informed decisions, ensuring the safety 
                    and satisfaction of your passengers.
                </p>
                <br>
                <h2>Key Features</h2>
                <ul>
                    <li><strong>Route Planning:</strong> Create and optimize routes for maximum efficiency.</li>
                    <li><strong>Driver Allocation:</strong> Assign drivers to buses and manage their schedules.</li>
                    <li><strong>Booking System:</strong> Handle reservations, cancellations, and customer inquiries with ease.</li>
                    <li><strong>Reporting:</strong> Generate detailed reports on bus usage, driver performance, and route efficiency.</li>
                    <li><strong>Real-time Updates:</strong> Get real-time data on bus locations, traffic conditions, and delays.</li>
                </ul>
                <p>
                    Use the sidebar to navigate through different sections of the system, where you can access detailed information 
                    and perform various management tasks.
                </p>
            </section>
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('toggle-btn');
        const sidebar = document.querySelector('.sidebar');
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>
</body>
</html>
