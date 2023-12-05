<?php
//session_start();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'capstone2');

$updateproducts = false;
$id1=0;
$outlet1=" ";
$street1=" ";
$city1=" ";
$state1=" ";
$postcode1=" ";
$mysqli = new mysqli('localhost', 'root', '', 'capstone2') or die(mysqli_error($mysqli));
if(isset($_POST['saveproducts'])){
    $id1 =$_POST['id'];
	$outlet1 =$_POST['outlet'];
	$street1 =$_POST['street'];
	$city1 =$_POST['city'];	
	$state1 =$_POST['state'];
    $postcode1 =$_POST['postcode'];
   			$mysqli->query("INSERT INTO outlets (id,outlets, street, city, state,postcode) VALUES('$id1','$outlets1','$street1','$city1','$state','$postcode')")or
			die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
		
	header("jobdescription: adminphp.php");
	
}

if(isset($_GET['deleteproducts'])){
    $id1 = $_GET['deleteproducts'];
    $mysqli->query("DELETE FROM outlets WHERE id =$id1") or die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("jobdescription: adminphp.php");
}

if(isset($_GET['editproducts'])){
    $id1 = $_GET['editproducts'];
    $updateproducts = true;
    $result = $mysqli->query("SELECT * FROM outlets WHERE id=$id1") or die($mysqli->error);
    if ($result){
	$row = $result->fetch_array();
    $id1= $row['id'];
	$outlets1= $row['outlets'];
	$street1= $row['street'];
    $city1 = $row['city'];
	$state1 = $row['state'];
    $postcode1 = $row['postcode'];
    }
}

if(isset($_POST['updateproducts'])){
	$id1 = $_POST['id'];
    $outlets1 =$_POST['outlets'];
	$street1 =$_POST['street'];
	$city1 =$_POST['city'];	
	$state1 =$_POST['state'];	
    $postcode1 =$_POST['postcode'];
	$mysqli->query("UPDATE outlets SET id='$id1',outlets='$outlets1', street='$street1', city='$city1', state='$state1', postcode='$postcode1' WHERE id=$id1") or die($mysqli->error);
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("jobdescription: adminphp.php");
}

?>