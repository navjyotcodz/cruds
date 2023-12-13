<?php
include 'conn.php';

session_start();

if($_GET['action'] == 'delete'){
$email =$_SESSION["user_name"];
$q = "DELETE FROM crudtables WHERE email='$email'"; 
$r = mysqli_query($conn,$q);

header('location:display.php');
}

?>