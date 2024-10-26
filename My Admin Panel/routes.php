<?php
session_start();
include('connection.php');
if (!isset($_SESSION['username']))
    header('location: index.php');

?>
<?php
$host = 'localhost';
$db = 'busms';
$user = 'root'; 
$pass = ''; 

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $busname = $_POST['busname'] ?? '';
    $busno = $_POST['busno'] ?? '';
    $source = $_POST['source'] ?? '';
    $destination = $_POST['destination'] ?? '';
    $frequency = $_POST['frequency'] ?? '';
    $estimated_time = $_POST['estimated_time'] ?? '';
    $bus_type = $_POST['bus_type'] ?? ''; 
    $price = $_POST['price'] ?? ''; 

    // Add a new bus
    if (isset($_POST['add'])) {
        $stmt = $conn->prepare("INSERT INTO addbus (busname, busno, source, destination, frequency, estimated_time, bus_type, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssi", $busname, $busno, $source, $destination, $frequency, $estimated_time, $bus_type, $price);
        $stmt->execute();
    }

    // Update an existing bus
    elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE addbus SET busname=?, busno=?, source=?, destination=?, frequency=?, estimated_time=?, bus_type=?, price=? WHERE id=?");
        $stmt->bind_param("ssssssssi", $busname, $busno, $source, $destination, $frequency, $estimated_time, $bus_type, $price, $id);
        $stmt->execute();
    }

    // Delete a bus
    elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM addbus WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

// Fetch all buses to display
$result = $conn->query("SELECT * FROM addbus");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routes And Schedules</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
    <style>
        h1 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
            padding: 10px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
        }

        input,
        select {
            margin-bottom: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            padding: 5px 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 3px;
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

        .edit-button,
        .delete-button {
            padding: 5px 10px;
        }

        .edit-button {
            background-color: #007bff;
            color: white;
        }

        .delete-button {
            background-color: #dc3545;
            color: white;
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
                <h2>Menu</h2>
            </div>
            <ul>
                <li><a href="dashboard.php"><i class="fas fa-tv"></i> Dashboard</a></li>
                <li><a href="view pass.php"><i class="fas fa-address-book"></i> View Pass</a></li>
                <li class="active"><a href="routes.php"><i class="fas fa-heart"></i> Routes</a></li>
                <li><a href="other_admin.php"><i class="fas fa-user"></i> Other Admin</a></li>
                <li><a href="about.php"><i class="fas fa-cogs"></i> About</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <header>
                <h1>Routes And Schedules</h1>
                <div class="toggle-btn" id="toggle-btn">&#9776;</div>
                <br>
            </header>
            <br>
            <br>
            <section>
                <div class="add-button">
                    <button onclick="showAddForm()" style="font-size: 1.1rem;">Add Bus</button>
                </div>
                <form id="busForm" method="POST" style="display:none;">

                    <input type="hidden" name="id" id="id" value=""><br>
                    <input type="text" name="busname" placeholder="Bus Name" required><br>
                    <input type="text" name="busno" placeholder="Bus Number" required><br>
                    <input type="text" name="source" placeholder="Source" required><br>
                    <input type="text" name="destination" placeholder="Destination" required><br>
                    <input type="text" name="frequency" placeholder="Frequency" required><br>
                    <input type="text" name="estimated_time" placeholder="Estimated Time" required><br>
                    <select name="bus_type" id="busType" required onchange="changeBusTypeColor(this)">
                        <option value="">Select Bus Type</option>
                        <option value="Regular">Regular</option>
                        <option value="Express">Express</option>
                    </select>
                    <br>
                    <input type="number" name="price" placeholder="price" required min="1">
                    <br>
                    <button type="submit" name="add">Add Bus</button>
                    <button type="button" onclick="hideAddForm()">Cancel</button>
                </form>
                <form id="editForm" method="POST" class="edit-form" style="display:none;">
                    <h3>Edit Bus</h3>
                    <input type="hidden" name="id" id="editId" value="">
                    <input type="text" name="busname" id="editBusname" placeholder="Bus Name" required>
                    <input type="text" name="busno" id="editBusno" placeholder="Bus Number" required>
                    <input type="text" name="source" id="editSource" placeholder="Source" required>
                    <input type="text" name="destination" id="editDestination" placeholder="Destination" required>
                    <input type="text" name="frequency" id="editFrequency" placeholder="Frequency" required>
                    <input type="text" name="estimated_time" id="editEstimatedTime" placeholder="Estimated Time"
                        required>
                    <select name="bus_type" id="editBusType" required onchange="changeEditBusTypeColor(this)">
                        <option value="">Select Bus Type</option>
                        <option value="Regular">Regular</option>
                        <option value="Express">Express</option>
                    </select>
                    <input type="number" name="price" id="editprice" placeholder="price" required min="1">

                    <button type="submit" name="update">Update Bus</button>
                    <button type="button" onclick="hideEditForm()">Cancel</button>
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>Bus Name</th>
                            <th>Bus Number</th>
                            <th>Source</th>
                            <th>Destination</th>
                            <th>Frequency</th>
                            <th>Estimated Time</th>
                            <th>Bus Type</th>
                            <th>Price(₹Rs)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?= $row['busname'] ?>
                                </td>
                                <td>
                                    <?= $row['busno'] ?>
                                </td>
                                <td>
                                    <?= $row['source'] ?>
                                </td>
                                <td>
                                    <?= $row['destination'] ?>
                                </td>
                                <td>
                                    <?= $row['frequency'] ?>
                                </td>
                                <td>
                                    <?= $row['estimated_time'] ?>
                                </td>
                                <td>
                                    <?= $row['bus_type'] ?>
                                </td>
                                <td>
                                    <?= $row['price'] ?>
                                </td>
                                <td>
                                    <button class="edit-button mb-3"
                                        onclick="showEditForm(<?= $row['id'] ?>, '<?= $row['busname'] ?>', '<?= $row['busno'] ?>', '<?= $row['source'] ?>', '<?= $row['destination'] ?>', '<?= $row['frequency'] ?>', '<?= $row['estimated_time'] ?>', '<?= $row['bus_type'] ?>', <?= $row['price'] ?>)">Edit</button>

                                    <form method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" name="delete" class="delete-button">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
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
    <script>
        function showAddForm() {
            document.getElementById('busForm').style.display = 'block';
            document.getElementById('editForm').style.display = 'none';
        }
        function hideAddForm() {
            document.getElementById('busForm').style.display = 'none';
            resetBusTypeColor();
        }
        function showEditForm(id, busname, busno, source, destination, frequency, estimated_time, bus_type, price) {
            document.getElementById('editId').value = id;
            document.getElementById('editBusname').value = busname;
            document.getElementById('editBusno').value = busno;
            document.getElementById('editSource').value = source;
            document.getElementById('editDestination').value = destination;
            document.getElementById('editFrequency').value = frequency;
            document.getElementById('editEstimatedTime').value = estimated_time;
            document.getElementById('editBusType').value = bus_type;
            document.getElementById('editprice').value = price;
            changeEditBusTypeColor(document.getElementById('editBusType'));
            document.getElementById('editForm').style.display = 'block';
            hideAddForm();
        }
        function hideEditForm() {
            document.getElementById('editForm').style.display = 'none';
        }
        function confirmDelete() {
            return confirm("Are you sure you want to delete this bus?");
        }
        function changeBusTypeColor(select) {
            const busType = select.value;
            const form = document.getElementById('busForm');
            form.className = busType;
        }
        function changeEditBusTypeColor(select) {
            const busType = select.value;
            const form = document.getElementById('editForm');
            form.className = busType;
        }
        function resetBusTypeColor() {
            const form = document.getElementById('busForm');
            form.className = '';
        }
    </script>
</body>

</html>