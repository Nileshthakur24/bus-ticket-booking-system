<?php
include ("connection.php");
if(isset($_POST['btnsubmit'])){
    $fname = $_POST['first-name'];
    $lname = $_POST['last-name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $insert = "INSERT INTO tbl_reg VALUES(0,'$fname','$lname','$address',$mobile,'$email','$password')";
    if (mysqli_query($connection, $insert)){
        header("Location: index.php");
    }
    else{
        echo "Error";    
    }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url(images/bg.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .registration-container {
            background-color: #fff;
            padding: 21px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            margin: 10px;
            background-color: rgba(255, 255, 255, 0.7);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-group input[type="text"],
        .input-group input[type="tel"],
        .input-group input[type="email"],
        .input-group input[type="password"],
        .input-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .input-group textarea {
            resize: none;
        }

        .input-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        @media (max-width: 480px) {
            .registration-container {
                padding: 15px;
            }

            .input-group label {
                font-size: 14px;
            }

            .input-group input[type="text"],
            .input-group input[type="tel"],
            .input-group input[type="email"],
            .input-group input[type="password"],
            .input-group textarea {
                font-size: 14px;
                padding: 8px;
            }

            .input-group input[type="submit"] {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
    <script>
        function validateForm() {
            let isValid = true;
            document.querySelectorAll('.error-message').forEach(el => el.innerText = '');
            const firstName = document.forms["registrationForm"]["first-name"].value;
            const lastName = document.forms["registrationForm"]["last-name"].value;
            const address = document.forms["registrationForm"]["address"].value;
            const mobile = document.forms["registrationForm"]["mobile"].value;
            const email = document.forms["registrationForm"]["email"].value;
            const password = document.forms["registrationForm"]["password"].value;
            if (firstName === "") {
                document.getElementById('first-name-error').innerText = "First name is required";
                isValid = false;
            }
            if (lastName === "") {
                document.getElementById('last-name-error').innerText = "Last name is required";
                isValid = false;
            }
            if (address === "") {
                document.getElementById('address-error').innerText = "Address is required";
                isValid = false;
            }
            const mobilePattern = /^[0-9]{10}$/;
            if (!mobilePattern.test(mobile)) {
                document.getElementById('mobile-error').innerText = "Please enter a valid 10-digit mobile number";
                isValid = false;
            }
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                document.getElementById('email-error').innerText = "Please enter a valid email address";
                isValid = false;
            }
            if (password.length < 6) {
                document.getElementById('password-error').innerText = "Password must be at least 6 characters long";
                isValid = false;
            }

            return isValid;
        }
    </script>
</head>

<body>
    <div class="registration-container">
        <h2>Registration</h2>
        <form name="registrationForm" action="register.php" method="POST" autocomplete="off" onsubmit="return validateForm();">
            <div class="input-group">
                <label for="first-name">First Name</label>
                <input type="text" name="first-name">
                <div id="first-name-error" class="error-message"></div>
            </div>
            <div class="input-group">
                <label for="last-name">Last Name</label>
                <input type="text" name="last-name">
                <div id="last-name-error" class="error-message"></div>
            </div>
            <div class="input-group">
                <label for="address">Address</label>
                <textarea name="address" rows="3"></textarea>
                <div id="address-error" class="error-message"></div>
            </div>
            <div class="input-group">
                <label for="mobile">Mobile Number</label>
                <input type="tel" name="mobile" required pattern="[0-9]{10}">
                <div id="mobile-error" class="error-message"></div>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" name="email">
                <div id="email-error" class="error-message"></div>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password">
                <div id="password-error" class="error-message"></div>
            </div>
            <div class="input-group">
                <input type="submit" name="btnsubmit" value="Submit">
            </div>
        </form>
    </div>
</body>

</html>
