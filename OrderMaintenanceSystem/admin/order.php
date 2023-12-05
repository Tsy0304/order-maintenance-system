<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $handler = mysqli_connect("localhost", "root", "", "capstone2");
    $query = "SELECT * FROM `staff` WHERE email ='".$_SESSION['email']."'";
    $result = mysqli_query($handler, $query);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $row["email"];
} else {
}

// sql statement for logged in customer's orders from  the order_list database 
$GetProd="SELECT * FROM order_list";  
//query to get the customer's orders
$GetProdRes=mysqli_query($handler, $GetProd);
// query to get date of each orders
$productGroups = mysqli_fetch_all($GetProdRes, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<title>Order</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/products.css" type="text/css">
<link rel="stylesheet" href="../css/purchasehistory.css" type="text/css">
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
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<button onclick="showLogoutDiv()" class="nav-contact nav-list logged-in">';
            echo "Hello, ",$_SESSION['name'],"!"; 
            echo '</button>';
        } else {
            echo '<a class="nav-contact nav-list" href="login.php">';
            echo "Login";
            echo '</a>';
        }
        ?>
         <!--Shopping Cart Icon-->
         <img class="my-cart cart-icon" src="../img/cart.svg" alt="cart">
        <a class="nav-list" onclick="phome()">Products<div ></div></a>
        <a class="nav-list" onclick="details()">Details<div></div></a>
        <a class="nav-list" onclick="order()">Orders<div class="nav-active"></div></a>
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
    <div id="logout-box" style="left: 50%; transform: translate(550px);">
    <div class="account-button"><a onclick="profile()">My Account</a></div>
        <div class="account-button"><a onclick="purchasehistory()">Purchase History</a></div>
        <div class="account-button"><a href="../profile/logout.php">Log Out</a></div>
    </div>
</div>  
<!-- Main Content -->

<div class="background" style="padding-top: 100px; height: 850px">
    <div class="ordercontainer">
        <div class="titlebox">
        <h1 class="title"> Order </h1>  
    </div>
        <div class="cart-container" id="style-1">
        <table class="order-title">
        <tr>
            <td>Order Id</td>
            <td>Product Ordered</td>
            <td>Product Name</td>
            <td>Product Code</td>
            <td>Quantity</td>
            <td>Price</td>
            <td>Staff name</td>
            <td>Delivery Recipient</td>
            <td>Billing Recipient</td>
            <td>Outlets</td>
            <td>Delivery Date</td>
            <td>Payment Method</td>
            <td></td>
            <td></td>
            </tr> 
        </table>
        <?php 
        $counter = 0;
        foreach($productGroups as $productGroup){ 
        $products= json_decode($productGroup["products"], true);
        foreach($products as $product){ 
          $counter += 1;
          ?>
            <table class="cart-table">
            <tr>
            <td> <?=$productGroup['orderID']?> </td>
            <td> <img src="<?=$product['image']?>"> </td>
            <td> <?=$product['name']?> <br> 
            <td><?=$product['code']?> </td>
            <td><?=$product['qty']?></td>
            <td><?=$product['price']?></td>
            <td> <?=$productGroup['staffname']?> </td>
            <td> <?=$productGroup['deliveryrecipient']?> </td>
            <td> <?=$productGroup['billingrecipient']?> </td>
            <td> <?=$productGroup['outlets']?> </td>
            <td> <?=$productGroup['deliveryDate']?> </td>
            <td> <?=$productGroup['paymentMethod']?> </td>
            <td>
            <button class="invoice" style="width:150px;"><a href="deliveryorder.php?outlet=<?= $selectedOutlet ?>&orderID=<?= $productGroup['orderID'] ?>"
                            class="btn btn-info">Delivery Order</a></button>
            </td>
            <td>
            <button class="invoice" style="margin-left:50px;"><a href="invoice.php?outlet=<?= $selectedOutlet ?>&orderID=<?= $productGroup['orderID'] ?>"
                            class="btn btn-info">Invoice</a></button>
            </td>
            </tr>
            <?php }} 
            if ($counter == 0) {
              echo "<div class='nothing-inside'>You have not purchased any products.</div>";
            }
            ?>
          </table>
    
        </div>
  </div> 
  </div>
  

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