<?php
include('../profile/auth.php');
?>
<!DOCTYPE html>
<html>
<title>My Cart</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/cart.css" type="text/css">
<link rel="stylesheet" href="../css/products.css" type="text/css">
<head>
<link rel="icon" href="../img/book.png">
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


<!--Remove products from local storage key "toCheckout" when page is refreshed-->
<body onload="refresh()" onpageshow="refresh()" id="style-1"> 
<div id="home" class="nav-bar">
    <nav class="nav-box">
        <a class="logo-text">
            <img class="nav-logo" src="../img/book.png" alt="Book">
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
        <a class="nav-list" onclick="outlets()">Outlets<div></div></a>
        <a class="nav-list" onclick="book()">Book<div></div></a>
        <a class="nav-list" onclick="staff()">Staff</div></a>
        
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

    <!--Drop Down List for Profile, Purchase History and Logout-->
    <div id="logout-box" style="left: 50%; transform: translate(550px);">
    <div class="account-button"><a onclick="profile()">My Account</a></div>
        <div class="account-button"><a onclick="purchasehistory()">Purchase History</a></div>
        <div class="account-button"><a href="../profile/logout.php">Log Out</a></div>
    </div>
</div>  

<!-- Main Content -->
  <div class="background">
    <h1>My Cart</h1>

    <!--Progress Bar-->
    <div class="progress-bar-container">
      <ul class="progress-bar">
          <li class="active">Cart</li>
          <li>Total</li>
          <li>Details</li>
          <li>Complete</li>
      </ul>
  </div>
  <br>

    <!--Products in shopping cart-->
    <div class="table-title">Product
      <span style="padding-left: 430px">Quantity</span>
      <span style="padding-left: 30px">Subtotal</span>
    </div>
    <div class="cart-container" id="style-1">
          <table class="cart-table" id="cart-table1"></table>
    </div>

    <!--Proceed to Payment button-->
    <a onclick="phome()"><button class="previous-button" style="float: left;">Back to Products</button></a>
    <button class="next-button" style="transform: translate(710px, 40px);" onclick="checkboxChecked()">Checkout</button>
  </div>

<!--Link to cart.js-->
<script src="../js/cart.js"></script>
<!--Add to Cart Function-->
<script src="../js/addToCart.js"></script>

<!--Display Account Drop Down List-->
<script>

function redirectToCart() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../admin/cart.php?outlet=' + selectedOutlet;
  }

  function outlets() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../admin/outlet.php?outlet=' + selectedOutlet;
  }


  function details() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../admin/details.php?outlet=' + selectedOutlet;
  }

  function order() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../admin/order.php?outlet=' + selectedOutlet;
  }

  function invoice() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../admin/invoice.php?outlet=' + selectedOutlet;
  }

  function profile() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../admin/profile.php?outlet=' + selectedOutlet;
  }

  function purchasehistory() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../admin/purchasehistory.php?outlet=' + selectedOutlet;
  }

  function phome() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../admin/products.php?outlet=' + selectedOutlet;
  }

  function book() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../admin/book.php?outlet=' + selectedOutlet;
  }

  function staff() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../admin/staff.php?outlet=' + selectedOutlet;
  }
// display message if no checkbox is checked 
function checkboxChecked() {
    const valid = localStorage.getItem('toCheckout');
    if (valid) {
        let selectedItems = JSON.parse(localStorage.getItem('toCheckout'));26
        if (selectedItems.length != 0) {
            // redirect to checkout page if at least one product is selected 
            var selectedOutlet = '<?= $selectedOutlet ?>';
            window.location = '../admin/checkout.php?outlet=' + selectedOutlet;
        }
        else {
            alert("Please select at least one product to be checked out.")
        }
    }
    else {
        alert("Please select at least one product to be checked out.")
    }
}

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