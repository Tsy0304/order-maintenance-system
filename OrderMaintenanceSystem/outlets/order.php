<?php
include('../profile/auth.php');
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
  <style>
      select{background-color: #008CB6;
        color:white;
        border-color:transparent;}

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
<?php
$handler = mysqli_connect("localhost", "root", "", "capstone2");

// sql statement for logged in customer's orders from  the order_list database 
$GetProd="SELECT * FROM order_list"; 
//query to get the customer's orders
$GetProdRes=mysqli_query($handler, $GetProd);
// query to get date of each orders
$productGroups = mysqli_fetch_all($GetProdRes, MYSQLI_ASSOC);

?>
<body onload="checkurl()" id="style-1ff" style="display: flex;  justify-content: center; align-items: center; flex-direction: column;">
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
         <a class="nav-list" href="../outlets/details.php">Details<div></div></a>
        <a class="nav-list" href="../outlets/order.php">Order<div class="nav-active"></div></div></a>

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
      <div class="account-button"><a href="../outlets/profile.php">My Account</a></div>
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
            <button class="invoice" style="width:150px;"><a href="deliveryorder.php?orderID=<?= $productGroup['orderID'] ?>"
                            class="btn btn-info">Delivery Order</a></button>
            </td>
            <td>
            <button class="invoice" style="margin-left:50px;"><a href="invoice.php?orderID=<?= $productGroup['orderID'] ?>"
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


<!--Add to Cart Function-->
</body>
</html>