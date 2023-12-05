<?php
session_start();
if(!isset($_SESSION["email"])){ 
header('../profile/login.php'); // redirect user to log in 
}
?>
<!DOCTYPE html>
<html>
<title>Outlets</title>
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
<head>
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
</style>
</head>
<?php
if (isset($_GET['outlet'])) {
  $selectedOutlet = $_GET['outlet'];
  // Now you can use $selectedOutlet as needed
} else {
  // Handle the case when 'outlet' parameter is not set, or set a default value
  $selectedOutlet = 'd'; // Replace with your default value
}
?>

<body style="height: 1700px" id="style-1">
<!-- Navigation Bar -->
  <div id="home" class="nav-bar">
    <nav class="nav-box">
        <a class="logo-text" >
            <img class="navigate-logo" src="../img/book.png" alt="Book">
            <b>Genius</b>
        </a>
        <?php 
        // display first name if user is logged in 
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
        <img class="my-cart cart-icon" src="../img/cart.svg" alt="cart">
        <a class="nav-list" onclick="phome()">Products<div></div></a>
        <a class="nav-list" onclick="details()">Details<div></div></a>
        <a class="nav-list" onclick="order()">Orders<div></div></a>
        <a class="nav-list" onclick="outlets()">Outlets <div class="nav-active"></div></div></a>
        
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
        <div class="account-button"><a onclick="profile()">My Account</a></div>
        <div class="account-button"><a onclick="purchasehistory()">Purchase History</a></div>
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

<!-- Main Content -->
  <div class="background" style="height: 1650px">
  <div class="container">
    <?php 
        $mysqli = new mysqli('localhost', 'root', '', 'capstone2') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM outlets") or die($mysqli_error);
        //pre_r($result);
        ?>
        <br><p style="font-size:20px; color:green;">Manage Outlets Details:</p><br>
        <div class="row justify-content-center">
            <table class="table table-align">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Outlets ID</th>
                        <th>Outlets</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Postcode</th>
                        <th colspan="5">Action</th>
                        <th><a href="addoutlet.php?outlet=<?php echo $selectedOutlet; ?>"
                            class="btn btn-danger">Add</a></th>
                    <tr>
                </thead>
        <?php
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['outletsID']; ?></td>
                    <td><?php echo $row['outlets']; ?></td>
                    <td><?php echo $row['street']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['state']; ?></td>
                    <td><?php echo $row['postcode']; ?></td>
                    <td>
                    <a href="outlet.php?deleteproducts=<?php echo $row['id']; ?>&outlet=<?php echo $selectedOutlet; ?>"
                      class="btn btn-danger">Delete</a>
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
</div>
<script src="../js/addToCart.js"></script>
<script>

function redirectToCart() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../sales/cart.php?outlet=' + selectedOutlet;
  }

  function outlets() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../sales/outlet.php?outlet=' + selectedOutlet;
  }

  function details() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../sales/details.php?outlet=' + selectedOutlet;
  }

  function order() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../sales/order.php?outlet=' + selectedOutlet;
  }

  function invoice() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../sales/invoice.php?outlet=' + selectedOutlet;
  }

  function profile() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../sales/profile.php?outlet=' + selectedOutlet;
  }

  function purchasehistory() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../sales/purchasehistory.php?outlet=' + selectedOutlet;
  }

  function phome() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../sales/products.php?outlet=' + selectedOutlet;
  }

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