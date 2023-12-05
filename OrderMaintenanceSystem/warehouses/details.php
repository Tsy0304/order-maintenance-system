<?php
session_start();
if(!isset($_SESSION["email"])){ 
header('../profile/login.php'); // redirect user to log in 
}
?>
<!DOCTYPE html>
<html>
<title>Details</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/website.css" type="text/css">
<link rel="stylesheet" href="../css/products.css" type="text/css">
<head>
<link rel="icon" href="../img/book.png">
</head>
<body style="height: 1700px" id="style-1">
<!-- Navigation Bar -->
  <div id="home" class="nav-bar">
    <nav class="nav-box">
        <a class="logo-text" >
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
                <button class="checkout hidden" onclick="document.location='../sales/cart.php'">Check Out</button>
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

<!-- Main Content -->
  <div class="background" style="height: 1650px">
  
    <div class="aboutus-page">
      <br><br><b>About Us</b>
      <div class="title-line"></div>
      <div class="aboutus-col1">
        <p><b>Our Company</b></p><br><br>
        <p><b>Our Aim</b></p>
      </div>
      <div class="aboutus-col2">
      <p>Founded in 2019, in hopes to provide variety categories of books to customers. With more than 10 stores around Malaysia, Genius recently launched a website for the convenience of customers worldwide who wish to buy books.
           Genius warehouses located in Subang, Malaysia by a team of committed staff who are always updated on stock in order to 
           meet the needs of our customers. Everything we do at Genius is focused on:<br>
             &nbsp;&nbsp;&nbsp;• meet sustainable development goals (SDGs) at every stage<br>
             </p>
        <p><br>Our aim is to be the premier Shopping Mall servicing company in Malaysia and we seek to achieve this by striving and maintaining our swift and secure approach for our job while maintaining the utmost quality and standards.

        </p>
      </div>
    </div>
    <div class="aboutus-page" style="height: 650px">
        <br><br><b>Contact Us</b>
        <p class="contacts">5, Jalan Universiti, Bandar Sunway, 47500 Petaling Jaya, Selangor<br><br>+(60)12-3456789<br><br>genius@gmail.com</p>
        <div class="title-line"></div>
        <div class="mapouter"><div class="gmap_canvas"><iframe width="500" height="350" id="gmap_canvas" src="https://maps.google.com/maps?q=sunway%20university&t=&z=13&ie=UTF8&iwloc=&output=embed&hl=en" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-org.net"></a><br><style>.mapouter{position:relative;text-align:right;height:350px;width:500px;}</style><a href="https://www.embedgooglemap.net">how to add a google map to a website</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:350px;width:500px;}</style></div></div>
        <img class="icons" src="../img/contacts.svg">
        </div>
          </p>
        </div>
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
</body>
</html>