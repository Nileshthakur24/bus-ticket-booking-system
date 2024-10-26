<?php
session_start();
include('connect.php');
if (isset($_SESSION['name'])) {
    header('location:home.php');
}
if (isset($_POST['btnsubmit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['cpassword'];
    $insert = "insert into user values(0,'$name', '$email', '$password','$confirm_password',1)";
    if ($password !== $confirm_password) {
        $error1 = "password not matched";
    } elseif (mysqli_query($connect, $insert)) {
        $success = "Success: User Registered Successfully";
        $_SESSION['name'] = $email;
        header('location:home.php');
    } else {
        $error = "Error: Something Went Wrong";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus ms | Register</title>
    <link rel="favicon" href="./images/bus_logo2.png">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto';
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: transparent;
            color: #080808;
        }

        header .logo {
            font-size: 24px;
            font-weight: bold;
        }

        header .login-btn {
            background-color: #ff0000;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        header .login-btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        header .login-btn:active {
            transform: scale(1);
        }

        .logo {
            width: 60px;
        }

        .form-container {
            padding: 20px 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: white;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
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

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        }

        .login-link a:hover {
            text-decoration: underline;
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
    </style>
</head>

<body
    style=" background: linear-gradient(rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1)), url('images/bus_banner.jpg') no-repeat center center/cover">
</body>

<header class="d-inline-block">

    <a href="index.php" style=" text-decoration: none;">
        <img class="logo" src="./images/bus_logo2.png" alt="">
    </a>
</header>

<div class="container d-flex justify-content-center align-items-start">
    <div class="form-container shadow-lg mt-2">
        <h1 class="fw-semibold fs-3">Create an Account</h1>
        <?php
        if (isset($success)) {
        ?>
            <p style='color:green'>
                <?php echo $success; ?>
            </p>
        <?php } ?>
        <?php
        if (isset($error)) {
        ?>
            <p style='color:red'>
                <?php echo $error; ?>
            </p>
        <?php } ?>
        <form method="post" autocomplete="off">
            <label class="form-label fs-5" for="name">Name:</label>
            <input class="form-control mb-3" type="text" id="name" name="name" required>

            <label class="form-label fs-5" for="email">Email:</label>
            <input class="form-control mb-3" type="email" id="email" name="email" required>

            <label class="form-label fs-5" for="password">Password:</label>
            <input class="form-control mb-3" type="password" id="password" name="password" required>

            <label class="form-label fs-5" for="confirmPassword">Confirm Password:</label>
            <input class="form-control mb-3 fs-5" type="password" id="confirmPassword" name="cpassword" required>
            <?php
            if (isset($error1)) {
            ?>
                <p style='color:red'>
                    <?php echo $error1; ?>
                </p>
            <?php } ?>
            <button type="submit" name="btnsubmit">Register</button>
        </form>
        <div class="login-link">
            <p class="fs-5">Already have an account? <a class="fs-5" href="index.php">Login now</a></p>
        </div>
    </div>
</div>
</body>

</html>