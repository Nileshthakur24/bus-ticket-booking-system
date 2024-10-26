<?php
session_start();
include("connect.php");
if (!isset($_SESSION['name']))
    header('location:login.php');

?>
<?php
// Database connection
$host = 'localhost';
$db = 'busms'; // Your database name
$user = 'root'; // Your DB username
$pass = ''; // Your DB password

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the search
$buses = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $source = $_POST['source'] ?? '';
    $destination = $_POST['destination'] ?? '';
    $date = $_POST['date'] ?? '';

    // Fetch buses based on source and destination
    $stmt = $conn->prepare("SELECT * FROM addbus WHERE source = ? AND destination = ?");
    $stmt->bind_param("ss", $source, $destination);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $buses[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link href="index.css" rel="stylesheet">
    <link rel="stylesheet" href="font.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        body {
            width: 100%;
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
        @media (max-width: 600px) {
            .btn {
                padding: 12px 24px;
                font-size: 14px;
            }
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
        }

        select,
        input[type="date"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }

        button {
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-button {
            background-color: #4CAF50;
            color: white;
        }

        .search-button:hover {
            background-color: #45a049;
        }

        .cancel-button {
            background-color: #f44336;
            color: white;
        }

        .cancel-button:hover {
            background-color: #e53935;
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            button {
                font-size: 14px;
            }

            select,
            input[type="date"] {
                padding: 8px;
            }
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

        input {
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            padding: 10px;
            background-color: #1b5cfe;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
        }

        .Regular {
            background-color: #d1e7dd;
        }

        .Express {
            background-color: #cfe2ff;
        }

        .book-button {
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-block;
        }

        .book-button:hover {
            background-color: #0056b3;
        }

        .result {
            text-align: center;
            margin-top: -2rem;
            border-radius: 1rem;
            padding: 3rem;
        }

        .bus-result {
            border-radius: 1rem;
        }

        .schedule-main {
            margin-top: 50px;
        }

        .title,
        .result-title {
            padding: 8px;
            border-radius: 10px;
            color: white;
            display: inline-block;
            margin: 10px auto;
        }

        .title {
            width: fit-content;
        }

        .main {
            margin: 0 auto;
            height: fit-content;
            border: 2px solid transparent;
            height: fit-content;
            display: flex;
            justify-content: center;
        }

        .hero {
            margin-top: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: fit-content;
            width: 100%;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);
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
                        <a href="schedule.php" class=" nav-link active fs-5">Schedule</a>
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

                <?php echo $_SESSION['name']; ?><a class="btn-getstarted bg-success  px-2 py-1 rounded ms-4 login-btn text-decoration-none fs-6" href="logout.php">Logout</a>

            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container">
        <div class="main w-100">
            <div class="hero">
                <div class="schedule-main w-100">
                    <div class="">

                        <h1 class="title bg-secondary fs-3 d-flex justify-content-center">Search for a Bus</h1>

                        <form method="POST">
                            <input class="form-control mb-2 p-2 rounded" type="text" name="source" placeholder="Enter Source" required>
                            <input class="form-control mb-2 p-2 rounded" type="text" name="destination" placeholder="Enter Destination" required>
                            <input class="form-control mb-2 p-2 rounded" type="date" id="date" name="date" placeholder="Select Date" required>
                            <br>
                            <button type="submit">Search</button>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <div class="result">
        <?php if (!empty($buses)): ?>
            <h2 class="fs-3 result-title bg-secondary">Available Buses</h2>
            <table class="bus-result">
                <thead>
                    <tr>
                        <th style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;">Bus Name
                        </th>
                        <th style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;">Bus Number
                        </th>
                        <th style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;">Source</th>
                        <th style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;">Destination
                        </th>
                        <th style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;">Frequency
                        </th>
                        <th style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;"> Estimated
                            Time</th>
                        <th style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;">Bus Type
                        </th>
                        <th style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;">Price</th>
                        <th style="  background-color: rgba(255, 255, 255, 0.9); background-color: transparent;">Book Ticket
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($buses as $bus): ?>
                        <tr class="<?= htmlspecialchars($bus['bus_type']) ?>">
                            <td style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;">
                                <?= htmlspecialchars($bus['busname']) ?>
                            </td>
                            <td style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;">
                                <?= htmlspecialchars($bus['busno']) ?>
                            </td>
                            <td style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;">
                                <?= htmlspecialchars($bus['source']) ?>
                            </td>
                            <td style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;">
                                <?= htmlspecialchars($bus['destination']) ?>
                            </td>
                            <td style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;">
                                <?= htmlspecialchars($bus['frequency']) ?>
                            </td>
                            <td style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;">
                                <?= htmlspecialchars($bus['estimated_time']) ?>
                            </td>
                            <td style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;">
                                <?= htmlspecialchars($bus['bus_type']) ?>
                            </td>
                            <td style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;">
                                <?= htmlspecialchars($bus['price']) ?> INR
                            </td>
                            <td style="  background-color: rgba(255, 255, 255, 0.3); background-color: transparent;"><a
                                    href="book_ticket.php?busno=<?= htmlspecialchars($bus['busno']) ?>"
                                    class="book-button">Book</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <p>No buses found for the selected source and destination.</p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').setAttribute('min', today);
    });
</script>

</body>

</html>