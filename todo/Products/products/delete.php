<?php 
include_once "../connect.php";
$id=$_GET['id'];
$queryDelete ="DELETE FROM products WHERE id ='$id';";
$result =mysqli_query($conn,$queryDelete);
mysqli_close($conn);
header('Location:index.php')
?>