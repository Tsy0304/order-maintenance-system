<?php 
$handler = mysqli_connect("localhost", "root", "", "capstone2");
if (isset($_GET['outlet'])) {
    $selectedOutlet = $_GET['outlet'];
    // Now you can use $selectedOutlet as needed
  } else {
    // Handle the case when 'outlet' parameter is not set, or set a default value
    $selectedOutlet = 'd'; // Replace with your default value
  }

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
    header("Location:book.php?outlet=$selectedOutlet");
              };
?>