<?php
// $conn=mysqli_connect($severname,$usename,$password,$databasename)
$conn =mysqli_connect('localhost','themsuaxoa2','18082004','doan');
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
} 
echo " connect success ! ";
?>