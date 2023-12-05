<?php 
$handler = mysqli_connect("localhost", "root", "", "capstone2");
if (isset($_GET['outlet'])) {
    $selectedOutlet = $_GET['outlet'];
    // Now you can use $selectedOutlet as needed
  } else {
    // Handle the case when 'outlet' parameter is not set, or set a default value
    $selectedOutlet = 'd'; // Replace with your default value
  }

$staffID = $_POST['staffID'];
$name = $_POST['name'];
$department = $_POST['department'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber'];
$password = md5($_POST['password']); 
$outlets = $_POST['outlets'];
$sql_query = "INSERT INTO staff (staffID,name,department,email,phonenumber,password,outlets)
              VALUES ('$staffID','$name','$department','$email','$phonenumber','$password','$outlets')";
if(mysqli_query($handler, $sql_query)){
    header("Location:staff.php?outlet=$selectedOutlet");
              }else {
                // Handle the error here, for example:
                echo "Error updating record: " . mysqli_error($handler);
            }
?>