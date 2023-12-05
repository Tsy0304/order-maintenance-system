<?php
include("../profile/auth.php");
if(!isset($_SESSION["email"])){ // check if user is logged in 
  echo '<script>alert("You need to be logged in to proceed.")</script>';
  echo '<script>window.location.href = "../profile/login.php"</script>'; // redirect user to login page
  exit(); 
  }
?>
<!DOCTYPE html>
<html>
<title>Checkout</title>
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
<body id="style-1">
<!-- Navigation Bar -->
<div id="home" class="nav-bar">
    <nav class="nav-box">
        <a class="logo-text">
            <img class="nav-logo" src="../img/book.png" alt="Book">
            <b>Genius</b>
        </a>
        <?php 
        // display first name if user is checked in 
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
  <div class="background">
    <h1>Checkout</h1>

      <!--Progress Bar-->
      <div class="progress-bar-container">
        <ul class="progress-bar">
            <li class="previous">Cart</li>
            <li class="active">Total</li>
            <li>Details</li>
            <li>Complete</li>
        </ul>
      </div>
      <br>

    <!--Products to be Checked Out -->
    <div>
      <div class="table-title">
      <span>Product Ordered</span>
      <span style="padding-left: 350px">Quantity</span>
      <span style="padding-left: 150px">Subtotal</span>
    </div>
        <div class="cart-container" id="style-1">
          <table class="cart-table" id="cart-table2" >
          </table>

          <script>
            // retrieve products to be checked out from local storage 
            let productsCheckout = JSON.parse(localStorage.getItem('toCheckout'));
            if (!productsCheckout) {
                productsCheckout = []; 
            }

            // assign elements to variable names
            let table = document.getElementById('cart-table2');

            // dynamically populate table with products in cart 
            let total = 0; 
            let content = "";
            for (let i = 0; i < productsCheckout.length; i++) {
                content += "<tr style='background-color: #e8e8e8;'>";
                content += "<td><div class='item'><img src='" + productsCheckout[i].image + "'><div>" + productsCheckout[i].name + "<br><small>" + productsCheckout[i].code + "</small>" + "<br><br><small>Price: RM" + productsCheckout[i].basePrice + "</small></div><td>x" + productsCheckout[i].qty + "</td><td><span style='float: right; margin-right: 10px'>RM" + productsCheckout[i].price + "</span></td></div></td>";
                content += "</tr>";
                total += productsCheckout[i].price;
            }

            // order total 
            content += "<tr><td rowspan='6' ></td></tr>";
            content += "<tr><td style='margin-right: 10px'>Order Subtotal:</td><td>RM" + total + "</td></tr>";
            table.innerHTML = content; 
          </script>
        </div>
    </div>

    <!--buttons at the bottom-->
    <a onclick="redirectToCart()"><button class="previous-button" style="float: left;">Back to My Cart</button></a>
    <button class="next-button" onclick="shipping()">Continue</button>
  </div>

<!--Add to Cart Function-->
<script src="../js/addToCart.js"></script>
<script>
  // display message if no checkbox is checked 

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
function shipping() {
  var selectedOutlet = '<?= $selectedOutlet ?>';
  window.location = '../sales/shipping&billing.php?outlet=' + selectedOutlet;
}

function phome() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../sales/products.php?outlet=' + selectedOutlet;
  }
// Display Account Drop Down List
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


