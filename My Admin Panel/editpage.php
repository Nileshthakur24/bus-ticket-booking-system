<?php 
session_start();
include("connection.php");
if (!isset($_SESSION['username']))
    header('location: index.php');
    
if(isset($_GET['regid'])){
    $select = "SELECT * FROM tbl_reg WHERE reg_id=$_GET[regid]";
    $result = mysqli_query($connection,$select);
    $data = mysqli_fetch_assoc($result);
}
if(isset($_POST['btnsubmit'])){
    $fname = $_POST['first-name'];
    $lname = $_POST['last-name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $update = "UPDATE tbl_reg set fname='$fname',lname='$lname',address='$address',mobile=$mobile,email='$email',password='$password' WHERE reg_id=$_GET[regid]";
    if(mysqli_query($connection,$update)){
        header("location:other_admin.php?upmsg=success");
    }else{
        echo mysqli_error($connection);
    }
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Registration Page</title>
    <link rel="stylesheet" href="./css/editpage_style.css">
</head>
<body>
    <div class="registration-container">
        <h2> Edit Your Details</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="first-name">First Name</label>
                <input type="text"  name="first-name" value="<?php echo $data['fname'];?>" required>
            </div>
            <div class="input-group">
                <label for="last-name">Last Name</label>
                <input type="text"  name="last-name" value="<?php echo $data['lname'];?>" required>
            </div>
            <div class="input-group">
                <label for="address">Address</label>
                <textarea  name="address" rows="3" value="<?php echo $data['address'];?>" required></textarea>
            </div>
            <div class="input-group">
                <label for="mobile">Mobile Number</label>
                <input type="tel"  name="mobile"  value="<?php echo $data['mobile'];?>" required pattern="[0-9]{10}">
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email"  name="email" value="<?php echo $data['email'];?>" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password"  name="password" value="<?php echo $data['password'];?>" required>
            </div>
            <div class="button-group">
                <input type="submit" value="Submit" name="btnsubmit">
                <input type="button" value="Back" onclick="history.back()">
            </div>
        </form>
    </div>
</body>
</html>
