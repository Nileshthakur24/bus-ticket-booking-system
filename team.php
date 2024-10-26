<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Bus Ms | Team</title>
    <link rel="stylesheet" href="font.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f3f4f6, #e0e0e0);
            margin: 0;
            padding: 0;
            font-family: 'Roboto';
            background: linear-gradient(rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1)), url('images/bus_banner.jpg') no-repeat center center/cover;
            height: 100%;
            width: 100%;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5%;
            background: #1f1f1f;
            color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header .logo {
            font-size: 28px;
            font-weight: 700;
        }

        header a {
            color: #ffffff;
            text-decoration: none;
            font-size: 18px;
        }

        header a:hover {
            text-decoration: underline;
        }

        .header {
            box-shadow: 5px 0.2px 4px rgb(15, 15, 15);
            height: 84px;
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
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            box-sizing: border-box;
            max-width: 1200px;
            margin: 0 auto;
        }

        .team-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 1200px;
        }
        .group-leader {
            grid-column: 1 / -1;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 123, 255, 0.3);
            height: fit-content;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .team-member {
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: black;
        }

        .team-member img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 4px solid #f0f0f0;
        }

        .team-member h2 {
            font-size: 22px;
            margin-bottom: 5px;
            color: #333;
        }

        .team-member p {
            font-size: 16px;
            color: #666;
            margin: 5px 0;
        }

        .team-member .role {
            font-weight: 600;
            color: #007bff;
        }

        .team-member .roll-no {
            font-weight: 400;
            color: #555;
        }

        .team-member .description {
            font-size: 14px;
            color: #444;
            line-height: 1.4;
            margin: 10px 0 0;
        }
        .team-member:hover,
        .group-leader:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            color: white;
        }

        .group-leader:hover {
            background-color: white;
            color: black;
        }

        .logo {
            width: 50px;
        }
        @media (max-width: 600px) {
            .team-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg w-100">
        <div class="container-fluid">
            <a class="navbar-brand" href="./home.php">
                <img class="logo" src="./images/bus_logo2.png" alt="logo-png">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a href="team.php" class=" nav-link fs-5 active">Team</a>
                    </li>


                    <li class="nav-item">
                        <a href="contact.php" class="nav-link fs-5">Contact Us</a>
                    </li>

                    <li class="nav-item">
                        <a href="My Admin Panel/index.php" class="nav-link fs-5">Admin</a>
                    </li>
                </ul>


            </div>
        </div>
    </nav>


    <div class="container">
        <h1 class="mb-4 text-white">Introducing our Team Members</h1>
        <div class="team-container ">
            <div class="team-member group-leader"
                style="background-color: rgba(255, 255, 255, 0.2); background-color: #1f1f1f; color: white;">
                <img src="images/leader.jpg" alt="Nilesh Thakur">
                <h2 style=" color: white;">Nilesh Thakur</h2>
                <p class="role">Group Leader</p>
                <p class="roll-no" style=" color: white;">Roll No: 204</p>
                <p class="description" style=" color: white;">Leads the team and coordinates project efforts.</p>
            </div>
            <div class="team-member tm1"
                style="background-color: rgba(255, 255, 255, 0.2); background-color: #1f1f1f; color: white;">
                <img src="images/members.jpg" alt="Mehul Nawal">
                <h2 style=" color: white;">Mehul Nawal</h2>
                <p class="role">Frontend Developer</p>
                <p class="roll-no" style=" color: white;">Roll No: 116</p>
                <p class="description" style=" color: white;">Designs and builds the user interface.</p>
            </div>
            <div class="team-member"
                style="background-color: rgba(255, 255, 255, 0.2); background-color: #1f1f1f; color: white;">
                <img src="images/members.jpg" alt="Brijesh Ojha">
                <h2 style=" color: white;">Brijesh Ojha</h2>
                <p class="role">Backend Developer</p>
                <p class="roll-no" style=" color: white;">Roll No: 118</p>
                <p class="description" style=" color: white;">Handles server-side logic and database.</p>
            </div>
            <div class="team-member"
                style="background-color: rgba(255, 255, 255, 0.2); background-color: #1f1f1f; color: white;">
                <img src="images/gmember.jpeg" alt="Nishi Singh">
                <h2 style=" color: white;">Nishi Singh</h2>
                <p class="role">Backend Developer</p>
                <p class="roll-no" style=" color: white;">Roll No: 187</p>
                <p class="description" style=" color: white;">Optimizes server interactions and data handling.</p>
            </div>
        </div>
    </div>
</body>

</html>