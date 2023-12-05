<?php 
$handler = mysqli_connect("localhost", "root", "", "capstone2");
if (isset($_GET['outlet'])) {
    $selectedOutlet = $_GET['outlet'];
    // Now you can use $selectedOutlet as needed
  } else {
    // Handle the case when 'outlet' parameter is not set, or set a default value
    $selectedOutlet = 'd'; // Replace with your default value
  }
$outlets = $_POST['outlets'];
$outletsID = $_POST['outletsID'];
$street = $_POST['street'];
$state = $_POST['state'];
$city = $_POST['city'];
$postcode = $_POST['postcode'];
$sql_query = "INSERT INTO outlets (outletsID,outlets,street,city,state,postcode)
              VALUES ('$outletsID','$outlets','$street','$city','$state','$postcode')";
if(mysqli_query($handler, $sql_query)){
    header("Location:outlet.php?outlet=$selectedOutlet");
              };
?>