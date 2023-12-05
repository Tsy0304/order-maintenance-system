<?php
if (isset($_GET['bookID'])) {
  $bookID = $_GET['bookID'];
  // Now you can use $selectedOutlet as needed
} else {
  // Handle the case when 'outlet' parameter is not set, or set a default value
  $bookID = 'd'; // Replace with your default value
}
?>
<?php
if (isset($_GET['outlet'])) {
  $selectedOutlet = $_GET['outlet'];
  // Now you can use $selectedOutlet as needed
} else {
  // Handle the case when 'outlet' parameter is not set, or set a default value
  $selectedOutlet = 'd'; // Replace with your default value
}
?>
<?php
include("../profile/auth.php");
if(!isset($_SESSION["email"])){
  header("Location: ../profile/login.php");
  exit(); }
$handler = mysqli_connect("localhost", "root", "", "capstone2"); // connect to database 
?>
<!DOCTYPE html>
<html>
<title>Edit Book</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/cart.css" type="text/css">
<link rel="stylesheet" href="../css/products.css" type="text/css">
<link rel="stylesheet" href="../css/shipping&billing.css" type="text/css">
<head>
  <link rel="icon" href="book.png">
  <style>
    .fix1{
      width:500px;
      margin-left: 90px;
      text-align: left;
    }
    .fix2{
      width:500px;
      margin-left: 63px;
      text-align: left;
    }
    .fix3{
      width:800px;
      margin-left: 63px;
      text-align: left;
    }
  </style>
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
        // show first name if user is logged in
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
<?php
$handler = mysqli_connect("localhost", "root", "", "capstone2");
$GetProd = "SELECT * FROM book WHERE bookID='$bookID'";
$GetProdRes = mysqli_query($handler, $GetProd);
$productGroup = mysqli_fetch_assoc($GetProdRes);
?>
<!-- Main Content -->
  <div class="background" style="height: 1010px">
    <h1>Edit Book</h1>
      <div id="error"></div>
          <!--Shipping Info -->
          <form class="form" id="ship&bill-form" action="editbookdatabase.php?bookID=<?=$bookID?>&outlet=<?php echo $selectedOutlet; ?>" method="POST" autocomplete="on">
          <div>
              <div class="div-container">
                <div class="left-div" >
                  <h2>Book Information</h2>
                  <!--Delivery Address-->
                  <div class="form-control">
                    <label id="bookID" class="fix1" for="bookID">Book ID: <?=$productGroup['bookID']?></label>
                    <small>Error message</small>
                  </div>

                  <div class="form-control">
                    <label id="bookname" class="fix2" for="bookname">Book Name: <?=$productGroup['bookname']?></label>
                    <small>Error message</small>
                  </div>

                  <div class="form-control">
                    <label id="description" class="fix3" for="description">Description: <?=$productGroup['description']?></label>
                    <small>Error message</small>
                  </div>

                  <div class="form-control">
                    <label for="Quantity">Quantity: </label>
                    <input type="number" value="<?=$productGroup['quantity']?>" id="quantity" name="quantity" placeholder="" required>
                    <small>Error message</small>
                  </div>

                  <div class="form-control">
                    <label for="Cost">Cost: </label>
                    <input type="number" value="<?=$productGroup['cost']?>" id="cost" name="cost" placeholder="" required>
                    <small>Error message</small>
                  </div>

                  <div class="form-control">
                    <label for="Price">Price: </label>
                    <input type="number" value="<?=$productGroup['price']?>" id="price" name="price" placeholder="" required>
                    <small>Error message</small>
                  </div>

                  <div class="form-control">
                    <label for="laststockin">Last Stock In (YYYY-MM-DD): </label>
                    <input type="text" value="<?=$productGroup['laststockin']?>" id="laststockin" name="laststockin" placeholder="" required>
                    <small>Error message</small>
                  </div>
                </div>

              <!--Buttons-->
              <br>
              <div class="order-button">
                  <button type="submit" class="next-button" style="transform: translate(770px);">Submit</button>
              </div>
            </div>
          </form>

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

  form.addEventListener('submit', (e) => {
    let valid = formInputsCheck();

    if (!valid) {
        e.preventDefault(); // prevent form from submitting 
    }
    else {
      var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../admin/purchasesummary.php?outlet=' + selectedOutlet; // redirect to purchase summary page 
    }
});

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
<script src="../js/form3InputsCheck.js"></script>

</body>
</html>

