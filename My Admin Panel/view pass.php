<?php
session_start();
include('connection.php');
if (!isset($_SESSION['username']))
    header('location: index.php');

?>
<?php
$servername = "localhost"; 
$username = "root";   
$password = "";   
$dbname = "busms";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Routes And schedules</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
    <style>
        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .success,
        .error {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .active {
            background: #1c88f5;
        }
    </style>

</head>

<body>
    <div class="container">
        <nav class="sidebar">
            <div class="logo">
                <h2 style="color:white;">Menu</h2>
            </div>
            <ul>
                <li><a href="dashboard.php"><i class="fas fa-tv"></i> Dashboard</a></li>
                <li class="active"><a href="view pass.php"><i class="fas fa-address-book"></i> View Pass</a></li>
                <li><a href="routes.php"><i class="fas fa-heart"></i> Routes</a></li>
                <li><a href="other_admin.php"><i class="fas fa-user"></i> Other Admin</a></li>
                <li><a href="about.php"><i class="fas fa-cogs"></i> About</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <header>
                <h1>View Pass Ticket</h1>
                <div class="toggle-btn" id="toggle-btn">&#9776;</div>
            </header>
            <main>
                <section>
                    <br>
                    <h2>Bookings:</h2>

                    <?php if ($result->num_rows > 0): ?>
                        <table>
                            <tr>
                                <th>Bus No</th>
                                <th>Passenger Name</th>
                                <th>Seat Number</th>
                                <th>Reference Number</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td>
                                        <?php echo $row["busno"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $row["passenger_name"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $row["seat_number"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $row["reference_number"]; ?>
                                    </td>
                                    <td>
                                        <?php echo $row["email"]; ?>
                                    </td>
                                    <td>
                                        <form method="post" style="display:inline;">
                                            <input type="hidden" name="booking_id"
                                                value="<?php echo $row['reference_number']; ?>">
                                            <input type="submit" value="Delete"
                                                onclick="return confirm('Are you sure you want to delete this booking?');"
                                                style="font-size: 1rem; color: white; background-color: red; padding: 0.3rem; border-radius: 0.4rem;">
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    <?php else: ?>
                        <p>No bookings found.</p>
                    <?php endif; ?>

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['booking_id'])) {
                        $booking_id_to_delete = $_POST['booking_id'];

                        $stmt = $conn->prepare("DELETE FROM bookings WHERE reference_number = ?");
                        $stmt->bind_param("s", $booking_id_to_delete);

                        if ($stmt->execute()) {
                            echo '<div class="success">Record deleted successfully</div>';
                        } else {
                            echo '<div class="error">Error deleting record: ' . $stmt->error . '</div>';
                        }

                        $stmt->close();
                    }
                    $conn->close();
                    ?>
                </section>
            </main>
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