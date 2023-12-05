<?php 
$handler = mysqli_connect("localhost", "root", "", "capstone2");
if (isset($_GET['outlet'])) {
    $selectedOutlet = $_GET['outlet'];
    // Now you can use $selectedOutlet as needed
  } else {
    // Handle the case when 'outlet' parameter is not set, or set a default value
    $selectedOutlet = 'd'; // Replace with your default value
  }

$staffID = $_GET['staffID'];
$name = $_POST['name'];
$department = $_POST['department'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber'];
$outlets = $_POST['outlets'];
$sql_query = "UPDATE staff SET staffID='$staffID',name='$name',department='$department',email='$email',phonenumber='$phonenumber',outlets='$outlets' WHERE staffID='$staffID'";
if(mysqli_query($handler, $sql_query)){
    header("Location:staff.php?outlet=$selectedOutlet");
              };
?>
