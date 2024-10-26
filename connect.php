<?php
$server="localhost";
$username="root";
$password="";
$db="busms";
$connect = mysqli_connect($server,$username,$password,$db);
if(!$connect){
    echo "Connection Error" or die(mysqli_connect_error());
}
?>