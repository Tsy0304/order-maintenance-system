<?php 
$handler = mysqli_connect("localhost", "root", "", "capstone2");

$bookID = $_POST['bookID'];
$bookname = $_POST['bookname'];
$description = $_POST['description'];
$quantity = $_POST['quantity'];
$cost = $_POST['cost'];
$price = $_POST['price'];
$laststockin = $_POST['laststockin'];
$sql_query = "INSERT INTO book (bookID,bookname,description,quantity,cost,price,laststockin)
              VALUES ('$bookID','$bookname','$description','$quantity','$cost','$price','$laststockin')";
if(mysqli_query($handler, $sql_query)){
    header("Location:warehouses.php");
              };
?>