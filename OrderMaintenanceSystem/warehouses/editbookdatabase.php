<?php 
$handler = mysqli_connect("localhost", "root", "", "capstone2");

$bookID = $_GET['bookID'];
$quantity = $_POST['quantity'];
$cost = $_POST['cost'];
$price = $_POST['price'];
$laststockin = $_POST['laststockin'];
$sql_query = "UPDATE book SET bookID='$bookID',quantity='$quantity',cost='$cost',price='$price',laststockin='$laststockin' WHERE bookID='$bookID'";
if(mysqli_query($handler, $sql_query)){
    header("Location:warehouses.php");
              };
?>
