<?php
if (isset($_GET['outlet'])) {
  $selectedOutlet = $_GET['outlet'];
  // Now you can use $selectedOutlet as needed
} else {
  // Handle the case when 'outlet' parameter is not set, or set a default value
  $selectedOutlet = 'd'; // Replace with your default value
}

$handler = mysqli_connect("localhost", "root", "", "capstone2");

$bookID = $_GET['bookID'];
$quantity = $_POST['quantity'];
$cost = $_POST['cost'];
$price = $_POST['price'];
$laststockin = $_POST['laststockin'];
$sql_query = "UPDATE book SET bookID='$bookID',quantity='$quantity',cost='$cost',price='$price',laststockin='$laststockin' WHERE bookID='$bookID'";
if(mysqli_query($handler, $sql_query)){
    header("Location:book.php?outlet=$selectedOutlet");
              };
?>

