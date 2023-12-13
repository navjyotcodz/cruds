<?php
include'conn.php';
$id=$_GET['id'];
$status=$_GET['status'];

$q = "UPDATE crudtables SET status=$status WHERE id=$id";

mysqli_query($conn,$q);
header('location:display.php');


?>