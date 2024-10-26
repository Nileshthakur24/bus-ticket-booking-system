<?php 
session_start();
include('connection.php');

$error_message = ''; // Initialize error message variable

if(isset($_SESSION['username'])) {
    header("location:dashboard.php");
}

function login($email, $password) {
    global $connection, $error_message;

    $select = "SELECT fname, lname, reg_id FROM tbl_reg WHERE email='$email' AND password='$password'";
    $result = mysqli_query($connection, $select);
    $count = mysqli_num_rows($result);

    if (isset($_POST['remember-me'])) {
        setcookie('useremail', $email, time() + 30 * 24 * 60 * 60);
        setcookie('userpassword', $password, time() + 30 * 24 * 60 * 60);
    }

    if ($count > 0) {
        $_SESSION['username'] = $email;
        header("location:dashboard.php");
    } else {
        $error_message = "Error: Invalid credentials.";
    }
}

if (isset($_POST['btnlogin'])) {
    login($_POST['email'], $_POST['password']);
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            background-color: black;
            background-image: url(images/bg.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.7);
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 0.8rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
            margin-top: 1rem;
        }

        button:hover {
            background-color: #0056b3;
        }

        .register-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
    <a href=/busms/home.php><button type="submit">Home</button></a>
        <h1 style="text-align: center; text-transform: capitalize; font-weight: 700;">Admin Login</h1>

        <?php if ($error_message != ''): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="text" id="email" name="email" value="<?php if(isset($_COOKIE['useremail'])) echo $_COOKIE['useremail']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php if(isset($_COOKIE['userpassword'])) echo $_COOKIE['userpassword']; ?>" required>
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" name="remember-me"> Remember me
                </label>
            </div>
            <button type="submit" name="btnlogin">Login</button>
           
            <div class="register-link">
                <p>Don't have an account? <a href="#" onclick="window.location.href='PASSWORD.html'">Register now</a></p>
            </div>
        </form>
    </div>
</body>

</html>
