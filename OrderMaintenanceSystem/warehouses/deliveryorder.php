<?php
include('../profile/auth.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delivery Order</title>
    <!-- JSPDF CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <link rel="stylesheet" href="../css/products.css" type="text/css">
    <link rel="stylesheet" href="../css/purchasehistory.css" type="text/css">
    <style>
        .invoice-container {
            margin: 0 auto;
            margin-top:100px;
            width: 900px;
            border-radius: 10px;
            background-color: #f1f1f1;
            padding: 20px;
        }

        .center {
            text-align: center;
        }

        #button {
            background-color: red;
            border-radius: 5px;
            margin-left: 700px;
            margin-bottom: 5px;
            color: white;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            #print-content, #print-content * {
                visibility: visible;
            }
            #print-content {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>
<body>
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

<div class="invoice-container" id="print-content">
    <h1 class="center">Delivery Order</h1>
    <?php
    $handler = mysqli_connect("localhost", "root", "", "capstone2");
    $orderID = $_GET["orderID"];
    $GetProd = "SELECT * FROM order_list, staff WHERE $orderID = order_list.orderID";
    $GetProdRes = mysqli_query($handler, $GetProd);
    $productGroup = mysqli_fetch_assoc($GetProdRes);

    if ($productGroup) {
        $products = json_decode($productGroup["products"], true);
        ?>
        Order ID: <?=$productGroup['orderID']?><br>
        Order Date: <?=$productGroup['orderDate']?><br>
        Staff ID: <?=$productGroup['staffID']?><br>
        Staff Name: <?=$productGroup['staffname']?><br>
        Payment Method: <?=$productGroup['paymentMethod']?>
        <hr><br>
        <?php foreach ($products as $product) { ?>
            <img src="<?=$product['image']?>" alt="Product Image"><br>
            Book Name: <?=$product['name']?><br>
            Book Code: <?=$product['code']?><br>
            Quantity: <?=$product['qty']?><br>
        <?php } ?>
        <hr>
        Delivery Recipient: <?=$productGroup['deliveryrecipient']?><br>
        Outlets: <?=$productGroup['outlets']?><br>
        Delivery Street: <?=$productGroup['deliveryStreet']?><br>
        Delivery City: <?=$productGroup['deliveryCity']?><br>
        Delivery State: <?=$productGroup['deliveryState']?><br>
        Delivery Postcode: <?=$productGroup['deliveryPostcode']?><br>
        Delivery Date: <?=$productGroup['deliveryDate']?><br>
        <hr>
        Billing Recipient: <?=$productGroup['billingrecipient']?><br>
        Billing Street: <?=$productGroup['billingStreet']?><br>
        Billing City: <?=$productGroup['billingCity']?><br>
        Billing State: <?=$productGroup['billingState']?><br>
        Billing Postcode: <?=$productGroup['billingPostcode']?><br>
    <?php } ?>
    
</div>
<button class="btn btn-info" id="button" onclick="printInvoice()">Generate PDF</button>
<script>

  function printInvoice() {
    window.print();
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










