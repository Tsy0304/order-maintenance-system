<!DOCTYPE html>
<html>
<title>My Account</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/cart.css" type="text/css">
<link rel="stylesheet" href="../css/products.css" type="text/css">

<head>
  <link rel="icon" href="../img/book.png">
</head>
<body>
<?php
if (isset($_GET['outlet'])) {
  $selectedOutlet = $_GET['outlet'];
  // Now you can use $selectedOutlet as needed
} else {
  // Handle the case when 'outlet' parameter is not set, or set a default value
  $selectedOutlet = 'austin'; // Replace with your default value
}
?>
<?php
include('../profile/auth.php');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$handler1 = mysqli_connect("localhost", "root", "", "capstone2"); // connect to database
    $query = "SELECT * FROM `staff` WHERE email ='".$_SESSION['email']."'"; // retrieve user info
    $result = mysqli_query($handler1, $query);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['name'] = $row["name"];
    $_SESSION['email'] = $row["email"];
    $_SESSION['phonenumber'] = $row["phonenumber"];
    $_SESSION['password'] = $row["password"];
  ?>

 <!-- Navigation Bar -->
 <div id="home" class="nav-bar">
    <nav class="nav-box">
        <a class="logo-text">
            <img class="nav-logo" src="../img/book.png" alt="Book">
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
        <img class="my-cart cart-icon" src="../img/cart.svg" alt="cart">
        <a class="nav-list" onclick="phome()">Products<div></div></a>
        <a class="nav-list" onclick="details()">Details<div></div></a>
        <a class="nav-list" onclick="order()">Orders<div></div></a>
        <a class="nav-list" onclick="outlets()">Outlets</div></a>
        
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
  
<!-- Main Content -->
<div class="background" style="height: auto; padding-bottom: 70px; margin-bottom: 100px;">
  <h1>My Account</h1>
  <img class="account-image" src="../img/account.png" width="200px" height="200px">
  <div class="account-details">
  <div class="account-image-box"></div>

    <!-- Display user details -->
    <p><strong>Name: </strong><?php echo $_SESSION['name']; ?></p>
    <p><strong>E-mail: </strong><?php echo $_SESSION['email']; ?></p>
    <p><strong>Phone Number: </strong><?php echo $_SESSION['phonenumber']; ?></p>

    <!-- Edit profile button -->
    <input onclick="showEditDiv()" id="change" type="button" value="Edit Profile"><img src="../img/edit.png"  height="15px" width="15px"/>
    
    <div id="editDiv">
    <!-- Form for user to update details -->
    <form class="signup-form" style="margin-top: 15px;" id="update-form" method="post" name="update" >
      <div class="form-control">
        <input class="edit-account-details" type="text" id="name" name="name" placeholder="Name" required>
        <div class="form-error"><small>Error message</small></div>
      </div>
      <div class="form-control">
        <input class="edit-account-details" type="password" id="password" name="password" placeholder="Password" required>
        <div class="form-error"><small>Error message</small></div>
      </div>
      <div class="form-control">
        <input class="edit-account-details" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
        <div class="form-error"><small>Error message</small></div>
      </div>
      <div class="form-control">
        <input class="edit-account-details" type="text" id="phonenumber" name="phonenumber" pattern="[+][6]{1}[0]{1}[0-9]{9,10}" title="+60123456789" placeholder="Contact Number (+60)" onkeyup="saveValue(this);" required>
        <div class="form-error"><small>Error message</small></div>
      </div>
      <input class="update-button" type="submit" name="update" value="Update Profile" >
    </form> 
    </div>
  </div>
</div>

<?php
$db =  mysqli_select_db($handler1,'capstone2');
  if(count($_POST)>0) {
    // update user details in database
    mysqli_query($handler1,"UPDATE staff SET name='" . $_POST['name'] . "',password='" .md5($_POST['password']) . "' ,phonenumber='" . $_POST['phonenumber'] . "' WHERE email ='".$_SESSION['email']."'");
    echo '<script>alert("Your account details have been successfully updated.")</script>';
    echo '<script>window.location.href = "../profile/login.php"</script>'; // redirect user to login page
}
?>

<script>
    // show update form
    function showEditDiv() {
      var x = document.getElementById("editDiv");
      if (x.style.display === "block") {
        x.style.display = "none";
      } else {
        x.style.display = "block";
      }
}
</script>
</div>
</body>

</body>

<script src="../js/addToCart.js"></script>
<script src="../js/form4InputsCheck.js"></script>

<script>

function redirectToCart() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../sales/cart.php?outlet=' + selectedOutlet;
  }

  function details() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../sales/details.php?outlet=' + selectedOutlet;
  }

  function outlets() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../sales/outlet.php?outlet=' + selectedOutlet;
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
    window.location = '../sales/purchasehistory.php?outlet=' + selectedOutlet;
  }
// show account drop down list 
function showLogoutDiv() {
  var x = document.getElementById("logout-box");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
</html>
