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
    <title>About Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style_about.css">

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
                <li><a href="dashboard.php"><i class="fas fa-tv"></i> Dashboard</a></li>
                <li><a href="view pass.php"><i class="fas fa-address-book"></i> View Pass</a></li>
                <li class=""><a href="routes.php"><i class="fas fa-heart"></i> Routes</a></li>
                <li><a href="other_admin.php"><i class="fas fa-user"></i> Other Admin</a></li>
                <li class="active"><a href="about.php"><i class="fas fa-cogs"></i> About</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <header>
                <h1>About</h1>
                <div class="toggle-btn" id="toggle-btn">&#9776;</div>
            </header>


            <section class="thank-you">
                <h2>Thank You for Managing the Admin Panel!</h2>
                <p>
                    We appreciate your dedication to keeping the Bus Management System running smoothly. Your efforts ensure that
                    everything operates efficiently, and we hope to see you again soon.
                </p>
                <p>Visit us again for more updates and seamless management of your bus operations.</p>
                <button class="logout-btn"><a href="logout.php">Logout</a></button>
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