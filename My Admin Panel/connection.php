<?php
$server="localhost";
$username="root";
$password="";
$db="busms";
$connection = mysqli_connect($server,$username,$password,$db);
if(!$connection){
    echo "Connection Failed..!" or die(mysqli_connect_error());
}
?>  