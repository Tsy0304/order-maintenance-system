<?php
//session_start();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'capstone2');

$updateproducts = false;
$id1=0;
$bookID1=" ";
$bookname1=" ";
$description1=" ";
$quantity1=" ";
$cost1=" ";
$price1=" ";
$laststockin1=" ";
$mysqli = new mysqli('localhost', 'root', '', 'capstone2') or die(mysqli_error($mysqli));
if(isset($_POST['saveproducts'])){
    $id1 =$_POST['id'];
	$bookID1 =$_POST['bookID'];
	$bookname1 =$_POST['bookname'];
	$description1 =$_POST['description'];	
	$quantity1 =$_POST['quantity'];
    $cost1 =$_POST['cost'];
    $price1 =$_POST['price'];
    $laststockin1 =$_POST['laststockin'];
   			$mysqli->query("INSERT INTO book (id,bookID, bookname, description, quantity,cost,price,laststockin) VALUES('$id1','$bookID1','$bookname1','$description1','$quantity','$cost','$price','$laststockin')")or
			die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
		
	header("jobdescription: adminphp.php");
	
}

if(isset($_GET['deleteproducts'])){
    $id1 = $_GET['deleteproducts'];
    $mysqli->query("DELETE FROM book WHERE id =$id1") or die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("jobdescription: adminphp.php");
}

if(isset($_GET['editproducts'])){
    $id1 = $_GET['editproducts'];
    $updateproducts = true;
    $result = $mysqli->query("SELECT * FROM book WHERE id=$id1") or die($mysqli->error);
    if ($result){
	$row = $result->fetch_array();
    $id1= $row['id'];
	$bookID1= $row['bookID'];
	$bookname1= $row['bookname'];
    $description1 = $row['description'];
	$quantity1 = $row['quantity'];
    $cost1 = $row['cost'];
    $price1 = $row['price'];
    $laststockin1 = $row['laststockin'];
    }
}

if(isset($_POST['updateproducts'])){
	$id1 = $_POST['id'];
    $bookID1 =$_POST['bookID'];
	$bookname1 =$_POST['bookname'];
	$description1 =$_POST['description'];	
	$quantity1 =$_POST['quantity'];	
    $cost1 =$_POST['cost'];
    $price1 =$_POST['price'];	
    $laststockin1 =$_POST['laststockin'];	
	$mysqli->query("UPDATE book SET id='$id1',bookID='$bookID1', bookname='$bookname1', description='$description1', quantity='$quantity1', cost='$cost1', price='$price1', laststockin='$laststockin1' WHERE id=$id1") or die($mysqli->error);
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("jobdescription: adminphp.php");
}

?>