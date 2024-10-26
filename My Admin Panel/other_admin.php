<?php
session_start();
include("connection.php");
if (!isset($_SESSION['username']))
    header('location: index.php');

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    $delete = "DELETE FROM tbl_reg WHERE reg_id=$id";
    if (mysqli_query($connection, $delete)) {
        header("location:other_admin.php?msg=delete");
    } else {
        echo mysqli_error($connection);
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style_admin.css">

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
                <li><a href="routes.php"><i class="fas fa-heart"></i> Routes</a></li>
                <li class="active" ><a href="other_admin.php"><i class="fas fa-user"></i> Other Admin</a></li>
                <li><a href="about.php"><i class="fas fa-cogs"></i> About</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <header>
                <h1>Admin Information</h1>
                <div class="toggle-btn" id="toggle-btn">&#9776;</div>
            </header>

            <section class="user-info">
                <h2>Users</h2>
                <?php
                $select = "SELECT * FROM tbl_reg order by reg_id desc";
                $result = mysqli_query($connection, $select);
                $i = 1;
                while ($data = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="user-card">
                        <div class="user-details">
                            <h3><?php echo $data['fname']; ?></h3>
                            <p><?php echo $data['email']; ?></p>
                        </div>
                        <div class="user-actions">
                            <button class="edit-btn"><a href="editpage.php?regid=<?php echo $data['reg_id']; ?>">Edit</a></button>
                            <button class="delete-btn"><a href='other_admin.php?deleteid=<?php echo $data['reg_id']; ?>'
                                    onclick="return confirm('Are you sure to delete?');">Delete</a></button>
                        </div>
                    </div>
                <?php
                    $i++;
                }
                ?>
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