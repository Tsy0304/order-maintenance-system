<?php
include('../profile/auth.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Book</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css" />
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../css/homepage.css" type="text/css">
<link rel="stylesheet" href="../css/website.css" type="text/css">
<link rel="stylesheet" href="../css/products.css" type="text/css">
<link rel="icon" href="../img/book.png">
<style>
  .navigate-logo{
    float: left;
    padding-top: 10.5px;
    width: 45.5px;
   
  }
  .cart-icon{
    padding-top: 15.5px;
    width: 45.5px;
    height:45px;
  }

  .table-align{
    text-align: left;
  }

  .centershort{
    width:200px;
    margin-left:650px;
  }
</style>
</head>
<body onload="checkurl()" id="style-1ff" style="display: flex;  justify-content: center; align-items: center; flex-direction: column;">
<!-- Navigation Bar -->
<div id="home" class="nav-bar">
    <nav class="nav-box">
        <a class="logo-text">
            <img class="navigate-logo" src="../img/book.png" alt="Book">
            <b>Genius</b>
        </a>
        <?php 
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<button onclick="showLogoutDiv()" class="nav-contact nav-list logged-in">';
            echo "Hello, ",$_SESSION['name'],"!"; 
            echo '</button>';
        } else {
            echo '<a class="nav-contact nav-list" href="../profile/login.php">';
            echo "Login";
            echo '</a>';
        }
        ?>
         <!--Shopping Cart Icon-->
         <a class="nav-list" href="../warehouses/warehouses.php">Book<div></div></a>
        <a class="nav-list" href="../warehouses/details.php">Details<div></div></a>
        <a class="nav-list" href="../warehouses/outlet.php">Outlets<div></div></a>
        <a class="nav-list" href="../warehouses/order.php">Order</div></a>

        <!--Cart Drop Down List-->
        <div class="cart-list hide">
            <div class="overlay"></div>
            <div class="top">
                <button id="closeButton">
                    <i class="fa fa-close"></i>
                </button>
                <h3>My Cart</h3>
                    <br>
                    <button class="checkout hidden" onclick="redirectToCart()">Check Out</button>
            </div>
            <ul id="addItems"></ul>
        </div>
    </nav>
    <!--Account Drop Down List-->
    <div id="logout-box" style="left: 50%; transform: translate(550px);">
        <div class="account-button"><a href="../warehouses/profile.php">My Account</a></div>
        <div class="account-button"><a href="../profile/logout.php">Log Out</a></div>
    </div>
</div>  
<div>
  <?php require_once 'adminphp.php'; ?>

<?php
if (isset($_SESSION['message'])): ?>
<div class="alert alert-<?=$_SESSION['msg_type']?>">

<?php
    echo $_SESSION['message'];
    unset($_SESSION['message']); ?>

</div>
<?php endif ?>
</div>

<!-- Main Content -->
<div class="container">
    <?php 
        $mysqli = new mysqli('localhost', 'root', '', 'capstone2') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM book") or die($mysqli_error);
        //pre_r($result);
        ?>
        <br><p style="font-size:20px; color:green;">Manage Product Details:</p><br>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Book ID</th>
                        <th>Book Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                        <th>Price</th>
                        <th>Last Stock In</th>
                        <th colspan="5">Action</th>
                        <th><a href="addbook.php"
                            class="btn btn-danger">Add</a></th>
                    <tr>
                </thead>
        <?php
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['bookID']; ?></td>
                    <td><?php echo $row['bookname']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['cost']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['laststockin']; ?></td>
                    <td>
                        <a href="editbook.php?bookID=<?php echo $row['bookID']; ?>"
                            class="btn btn-info">Edit</a>
                            <!--<a href="warehouses.php?deleteproducts=<?php echo $row['id']; ?>"
                            class="btn btn-danger">Delete</a>-->
                    </td>
                </tr>
            <?php endwhile; ?>
            </table>
        </div>

        <?php
        function pre_r( $array ){
            echo'<pre>';
            print_r($array);
            echo '</pre>';}
    ?>   
</div>
<script src="../js/addToCart.js"></script>
<script>


// Display account drop down list 
function showLogoutDiv() {
  var x = document.getElementById("logout-box");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
</body>
</html>