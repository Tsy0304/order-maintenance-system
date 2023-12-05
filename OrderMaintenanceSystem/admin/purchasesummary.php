<?php
if (isset($_POST['selectedOutlet'])) {
  $selectedOutlet = $_POST['selectedOutlet'];
  // Now you have the selected outlet value in $selectedOutlet
} else {
  // Handle the case when 'selectedOutlet' is not set, or set a default value
  $selectedOutlet = 'd'; // Replace with your default value
}
?>

<!-- Rest of your purchasesummary.php code -->

<?php
include("../profile/auth.php");
if(!isset($_SESSION["email"])){
  header("Location: ../profile/login.php");
  exit(); }
// connect to database 
$handler = mysqli_connect("localhost", "root", "", "capstone2");

// shipping info
$deliveryrecipient = $_POST['d-recipient'];
$billingrecipient = $_POST['b-recipient'];
$dStreet = $_POST['d-street'];
$outlets = $_POST['d-outlets'];
$dCity = $_POST['d-city'];
$dState = $_POST['d-state'];
$dPostcode = $_POST['d-postcode'];
$deliveryDate = $_POST['delivery-date'];

// billing info
$deliveryrecipient = $_POST['d-recipient'];
$billingrecipient = $_POST['b-recipient'];
$bStreet = $_POST['b-street'];
$bCity = $_POST['b-city'];
$bState = $_POST['b-state'];
$bPostcode = $_POST['b-postcode'];
$paymentMethod = $_POST['payment-method'];

// products 
$products = $_POST['products-checkout'];

// order total 
$orderTotal = $_POST['order-total'];
$orderDate = $_POST['order-date'];

// insert data into order table 
$result = mysqli_query($handler, "SELECT * from staff where email ='".$_SESSION['email']."'");
$current_row_result = mysqli_fetch_assoc($result);
$staffID = $current_row_result["staffID"]; 
$staffname=$current_row_result["name"]; 
$sql_query = "INSERT INTO order_list (staffID,staffname, outlets, deliveryrecipient, products,  orderTotal, orderDate, deliveryStreet, deliveryCity, deliveryState, deliveryPostcode, deliveryDate,
billingrecipient,billingStreet, billingCity, billingState, billingPostcode, paymentMethod)
              VALUES ('$staffID','$staffname','$outlets', '$deliveryrecipient','$products', '$orderTotal', '$orderDate', '$dStreet', '$dCity', '$dState', '$dPostcode', '$deliveryDate', 
              '$billingrecipient','$bStreet', '$bCity', '$bState', '$bPostcode','$paymentMethod')";
$insert = mysqli_query($handler, $sql_query);

echo "<br>";

// retrieve order ID from database 
$sql_query1 = "SELECT orderID FROM order_list ORDER BY orderID DESC LIMIT 1";
$result_set_identifier = mysqli_query($handler, $sql_query1);
$result = mysqli_fetch_assoc($result_set_identifier);
?>

<!DOCTYPE html>
<html>
<title>Purchase Summary</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/cart.css" type="text/css">
<link rel="stylesheet" href="../css/products.css" type="text/css">
<head>
<link rel="icon" href="../img/book.png">
</head>
<body id="style-1">
<!-- Navigation Bar -->
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

    <!--Account Drop Down List-->
    <div id="logout-box" style="left: 50%; transform: translate(550px);">
    <div class="account-button"><a onclick="profile()">My Account</a></div>
        <div class="account-button"><a onclick="purchasehistory()">Purchase History</a></div>
        <div class="account-button"><a href="../profile/logout.php">Log Out</a></div>
    </div>
</div>  

<!-- Main Content -->
  <div class="background">
    <script>
      alert("Your order has been placed!");
    </script>
  
  <h1>Purchase Summary</h1>

  <!--Progress Bar-->
  <div class="progress-bar-container">
      <ul class="progress-bar">
        <li class="previous">Cart</li>
        <li class="previous">Total</li>
        <li class="previous">Details</li>
        <li class="active">Complete</li>
      </ul>
  </div>
  <br>

  <!--Products-->
  <div>
    <div class="table-title">Product Ordered
      <span style="padding-left: 350px">Quantity</span>
      <span style="padding-left: 150px">Subtotal</span>
    </div>
      <div class="cart-container" id="style-1">  
        <table class="cart-table" id="cart-table3" >
        </table>
        <!--Other Details-->
        <div style="background-color: black; width: 888px; height: 2px; margin-top: 5px"></div>
        <div class="order-summary-details">
            <br>
            <strong>Order ID: </strong>#<?php echo $result["orderID"] ;?>
            <br>
            <br>
            <strong>Delivery Recipient: </strong><?php echo $deliveryrecipient ;?>
            <br>
            <strong>Delivery Address: </strong><?php echo $dStreet .', ' . $dPostcode .' '. $dCity .', '. $dState; ?>
            <br>
            <strong>Delivery Date: </strong><?php echo $deliveryDate ;?>
            <br>
            <strong>Billing Address: </strong><?php echo $bStreet .', ' . $bPostcode .' '. $bCity .', '. $bState; ?>
            <br>
        </div>
        </div>

        <!--Button-->
        <a onclick="phome()"><button class="next-button" style="transform: translate(815px,40px)">Back to Products Page</button></a>
      </div>
  </div>

<script>
    // retrieve products to be checked out from local storage 'toCheckout'
    let productsCheckout = JSON.parse(localStorage.getItem('toCheckout'));
    if (!productsCheckout) {
        productsCheckout = []; 
    }

    // retrieve products from local storage 'shoppingCart'
    let productsInCart2 = JSON.parse(localStorage.getItem('shoppingCart'));
    if (!productsInCart2) {
      productsInCart2 = [];
    }

    // assign elements to variable names
    let table = document.getElementById('cart-table3');

    // dynamically populate table with products in cart 
    let total = 0; 
    let content = "";
    for (let i = 0; i < productsCheckout.length; i++) {
        content += "<tr style='background-color: #e8e8e8;'>";
        content += "<td><div class='item'><img src='" + productsCheckout[i].image + "'><div>" + productsCheckout[i].name + "<br><small>" + productsCheckout[i].code + "</small>" + "<br><br><small>Price: RM" + productsCheckout[i].basePrice + "</small></div><td>x" + productsCheckout[i].qty + "</td><td><span style='float: right;'>RM" + productsCheckout[i].price + "</span></td></div></td>";
        content += "</tr>";
        total += productsCheckout[i].price;
    }

    // order total 
    content += "<tr><td rowspan='6'></td></tr>";
    content += "<tr><td>Order Subtotal:</td><td>RM" + total + "</td></tr>";
    table.innerHTML = content;

    // remove ordered products from local storage key 'shoppingCart'
    productsInCart2 = productsInCart2.filter(function(obj) {
      return !this.has(obj.id);
    }, new Set(productsCheckout.map(obj => obj.id)));
    localStorage.setItem('shoppingCart',JSON.stringify(productsInCart2));

    // remove local storage key 'toCheckout'
    window.localStorage.removeItem('toCheckout');
</script>

<!--Add to Cart Function-->
<script src="../js/addToCart.js"></script>
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

</body>
</html>