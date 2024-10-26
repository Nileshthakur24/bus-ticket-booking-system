<?php
$host = 'localhost';
$db = 'busms';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$buses = [];
$result = $conn->query("SELECT busno, busname FROM addbus");
while ($row = $result->fetch_assoc()) {
    $buses[] = $row;
}
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $busno = $_POST['busno'];
    $passenger_name = $_POST['passenger_name'];
    $user_email = $_POST['email'];
    $seat_number = 'A1'; 
    $reference_number = uniqid('REF-');
    $stmt = $conn->prepare("INSERT INTO bookings (busno, passenger_name, seat_number, email, reference_number) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $busno, $passenger_name, $seat_number, $user_email, $reference_number);
    
    if ($stmt->execute()) {
        $message = "Booking successful!";
        $confirmation = "<div class='confirmation'>
                             <h2>Thank You for Your Booking!</h2>
                             <p><strong>Passenger Name:</strong> $passenger_name</p>
                             <p><strong>Bus Number:</strong> $busno</p>
                             <p><strong>Seat Number:</strong> $seat_number</p>
                             <p><strong>Email:</strong> $user_email</p>
                             <p><strong>Reference ID:</strong> <span class='reference-id'>$reference_number</span></p>
                          </div>";
    } else {
        $message = "Error: " . $stmt->error;
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="font.css">


    <style>
        body {
            background: linear-gradient(rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1)), url('images/bus_banner.jpg') no-repeat center center/cover;
            font-family: "Roboto";
            margin: 20px;
            padding: 20px 0px;
            background-color: #f4f4f4;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: #1f1f1f;
            color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    
        .logo{
            width: 50px;
        }

        .form-container {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: rgba(0, 0, 0, 0.8);

        }

        h1 {
            color: #28a745;
        }

        input,
        select {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .confirmation {
            margin-top: 20px;
            padding: 15px;
            background: #dff0d8;
            border: 1px solid #d6e9c6;
            border-radius: 5px;
        }

        .reference-id {
            font-weight: bold;
            font-size: 1.2em;
            color: #c9302c;
        }


        .home-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .home-button:active {
            transform: scale(0.95);
        }

        .home {
            background-color: rgb(19, 119, 240);
        }
    </style>
</head>

<body>

        <a href="./home.php" class="mb-4 mt-0">
            <img class="logo" src="./images/bus_logo2.png" alt="logo-png" class="mb-4">
        </a>

    <div class="form-container mt-3">
        <a href="home.php" class="home-button"><button class="home">Home</button></a>
        <br>
        <br>
        <h1>Book Your Ticket</h1>

        <form method="POST" action="">
            <select name="busno" required>
                <option value="">Confirm Bus</option>
                <?php foreach ($buses as $bus): ?>
                <option value="<?= $bus['busno'] ?>">
                    <?= $bus['busname'] ?>
                </option>
                <?php endforeach; ?>
            </select>

            <label for="passenger_name">Passenger Name:</label>
            <input type="text" name="passenger_name" placeholder="Passenger Name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Email" required>

            <button type="submit">Book Ticket</button>
        </form>

        <?php if (isset($confirmation)): ?>
        <?= $confirmation ?>
        <?php endif; ?>
    </div>

</body>

</html>

<?php
$conn->close();
?>