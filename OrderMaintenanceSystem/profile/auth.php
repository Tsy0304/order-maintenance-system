<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $handler1 = mysqli_connect("localhost", "root", "", "capstone2");
    $query = "SELECT * FROM `staff` WHERE email ='".$_SESSION['email']."'";
    $result = mysqli_query($handler1, $query);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['name'] = $row["name"];
} else {
}
?>