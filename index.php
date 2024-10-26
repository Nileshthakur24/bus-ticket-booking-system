<?php
session_start();
if (isset($_SESSION['name']))
    header('location:home.php');
include("connect.php");
function login($email, $password)
{
    global $connect;
    $select = "select * from user where email='$email' and password='$password'";
    $result = mysqli_query($connect, $select);
    $count = mysqli_num_rows($result);
    if (isset($_POST['chkRemember'])) {
        setcookie('email', $email, time() + (30 * 86400));
        setcookie('password', $password, time() + (30 * 86400));
    }
    if ($count > 0) {
        $_SESSION['name'] = $email;
        header("location: home.php");
    } else {
        $error = "Either email or password wrong";
        return $error;
    }
}

if (isset($_POST['btnsubmit'])) {
    $error = login($_POST['email'], $_POST['password']);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus ms | Login</title>
    <link rel="favicon" href="./images/bus_logo2.png">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="./font.css">
    <style>
        body {
            font-family: 'Roboto';
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
            background: linear-gradient(rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1)), url('images/bus_banner.jpg') no-repeat center center/cover
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: transparent;
            color: #ffffff;
        }

        header .logo {
            font-size: 24px;
            font-weight: bold;
            color: black;
        }

        header .login-btn {
            background-color: #ff0000;
            color: #ffffff;
            border: none;
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

        .logo-img {
            background-color: while;
        }
        .form-container {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
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

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .logo {
            width: 60px;
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

<body>
    <div class="container">
        <header class="logo-img">
            <a href="index.php" style=" text-decoration: none;">
                <img class="logo" src="./images/bus_logo2.png" alt="">
            </a>
        </header>

        <div class="container d-flex vh-100">
            <div class="d-flex justify-content-center w-100 h-100 align-items-center">
                <div class="form-container shadow-lg text-white">
                    <h1 class="text-white">Login</h1>
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

                    <form method="post">
                        <label class="form-label fs-5" for="email">Email:</label>
                        <input class="form-control mb-2" type="email" id="email" name="email" required>

                        <label class="form-label fs-5" for="password">Password:</label>
                        <input class="form-control mb-3" type="password" id="password" name="password" required>


                        <button class="" type="submit" name="btnsubmit" href="home.php">Login</button>
                    </form>
                    <div class="register-link">
                        <p class="fs-5">Don't have an account? <a class="fs-5" href="registration.php">Register now</a></p>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>