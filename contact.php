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
    <title> Bus ms | Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="font.css">


    <style>
        body {
            height: 100%;
            background: linear-gradient(rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1)), url('images/bus_banner.jpg') no-repeat center center/cover;
            font-family: "Roboto";
        }
     
        body {
            font-family: "Roboto";
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
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

        nav a::before {
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

        .logo {
            width: 50px;
        }

        .header {
            box-shadow: 5px 0.2px 4px rgb(15, 15, 15);
            height: 84px;

        }


        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 60px);
            padding: 20px;
            box-sizing: border-box;
            margin-top: 10%;

        }

        .form-container {
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
  
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-size: 14px;
            color: black;
            font-weight: bold;
        }

        input {
            margin-bottom: 20px;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            padding: 12px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
  
        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
            }

            input,
            button {
                font-size: 14px;
            }
        }

        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #343a40;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-size: 14px;
            color: #495057;
        }

        input,
        textarea {
            margin-bottom: 20px;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            min-height: 150px;
        }

        button {
            padding: 12px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        button:active {
            transform: scale(1);
        }
   
        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
            }

            input,
            textarea,
            button {
                font-size: 14px;
            }
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
                        <a href="home.php" class=" nav-link fs-5">Home</a>
                    </li>

                    <li class="nav-item">
                        <a href="schedule.php" class=" nav-link fs-5">Schedule</a>
                    </li>

                    <li class="nav-item">
                        <a href="team.php" class=" nav-link fs-5">Team</a>
                    </li>


                    <li class="nav-item">
                        <a href="contact.php" class="nav-link fs-5 active">Contact Us</a>
                    </li>

                    <li class="nav-item">
                        <a href="My Admin Panel/index.php" class="nav-link fs-5">Admin</a>
                    </li>
                </ul>

                <?php echo $_SESSION['name']; ?><a class="btn-getstarted ms-4 login-btn text-decoration-none fs-6 py-1 px-2 bg-success rounded-1" href="logout.php">Logout</a>

            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-between align-items-center h-100 h-100">
        <div class="form-container">
            <h1 class="text-black text-capitalize fw-bolder fs-2">Contact Us</h1>
            <form id="contactForm" method="post" action="https://formspree.io/f/xrbzvavl">
                <label class="form-label text-black fs-4 fw-bold" for="name">Name:</label>
                <input class="form-control" type="text" id="name" name="name" placeholder="Your Name" required>

                <label class="form-label text-black fs-4 fw-bold" for="email">Email:</label>
                <input class="form-control" type="email" id="email" name="email" placeholder="you@example.com" required>

                <label class="form-label text-black fs-4 fw-bold" for="subject">Subject:</label>
                <input class="form-control" type="text" id="subject" name="subject" placeholder="Subject" required>

                <label class="form-label text-black fs-4 fw-bold" for="message">Message:</label>
                <textarea id="message" name="message" placeholder="Your message here..." required> </textarea>

                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
</body>

</html>