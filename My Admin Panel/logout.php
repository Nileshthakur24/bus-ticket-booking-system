<?php 
session_start();
unset($_SESSION['username']);
setcookie('useremail', "", time() - 3600);
setcookie('userpassword', "", time() - 3600);
header('location: index.php');
?>
