
<html>
<head>
<title>Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/login.css" type="text/css">
</head>
<body>
<?php

session_start();
$handler = mysqli_connect("localhost", "root", "");
$handler1 = mysqli_connect("localhost", "root", "", "capstone2");

if (isset($_POST['email'])){
    $email= stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($handler1,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($handler1,$password);
        $query = "SELECT * FROM `staff` WHERE email='$email'
        and password='".md5($password)."'";
         $query_run = mysqli_query($handler1, $query);
         $types= mysqli_fetch_array($query_run);
         $staffID="SELECT staffID FROM `staff` WHERE email='$email'";
         if($types['department'] == "Warehouses")
         {
            $_SESSION['loggedin'] = true;
             $_SESSION['email'] = $email;
             header("Location:../warehouses/warehouses.php?staffID=$staffID");
         }
         else if($types['department'] == "Sales")
         {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("Location:../sales/products.php?staffID=$staffID");
         }
         else if($types['department'] == "Outlets")
         {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("Location:../outlets/order.php?staffID=$staffID");
         }
         else if($types['department'] == "Admin")
         {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("Location:../admin/products.php?staffID=$staffID");
         }
        else{
          echo '<script>alert("Incorrect Email/Password\nPlease try again.")</script>';
          echo '<script>window.location.href = "../profile/login.php"</script>';
	}
    }else{
?> 
<!-- Main Content -->
<div align="center" >
    <div>
    <form  id="loginform" action="" method="post" name="login">
      <label for="book"><img src="../img/book.png"  id="booklogo" alt="book" ></label><br>
      <label for="welcome" ><h1 style="color:white;">Welcome!</h1></label><br>
      <input class="logindetails" type="text" id="email" name="email" placeholder="name@email.com"><br><br>
      <input class="logindetails" type="password" id="password" name="password" placeholder="password"><br><br><br>
      <button type="submit" class="loginbutton" name="submit" value="submit">LOG IN</button>
    </div>
</div>
<?php } ?>
</body>
</html>

