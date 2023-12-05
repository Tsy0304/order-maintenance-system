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
<title>Shipping & Billing Info</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/cart.css" type="text/css">
<link rel="stylesheet" href="../css/products.css" type="text/css">
<link rel="stylesheet" href="../css/shipping&billing.css" type="text/css">
<head>
  <link rel="icon" href="book.png">
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
  <div class="background" style="height: 1010px">
    <h1>Shipping & Billing Information</h1>

      <!--Progress Bar-->
      <div class="progress-bar-container">
        <ul class="progress-bar">
            <li class="previous">Cart</li>
            <li class="previous">Total</li>
            <li class="active">Details</li>
            <li>Complete</li>
        </ul>
      </div>
      <br>

    <?php
    $result="SELECT * from outlets where outlets.outlets = '$selectedOutlet'";
    $result2 = mysqli_query($handler, $result);
    $result3 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    $result4="SELECT * from staff where email ='".$_SESSION['email']."'";
    $result5 = mysqli_query($handler, $result4);
    $result6 = mysqli_fetch_all($result5, MYSQLI_ASSOC);

    ?>
    


    <div id="error"></div>
          <!--Shipping Info -->
          <form class="form" id="ship&bill-form" action="purchasesummary.php?outlets=<?=$selectedOutlet?>" method="post" autocomplete="on">
          <input type="hidden" name="selectedOutlet" value="<?= $selectedOutlet ?>">
          <div>
              <div class="div-container">
                <div class="left-div">
                  <h2>Delivery Information</h2>
                  <!--Delivery Address-->
                  <div class="form-control">
                    <label for="d-recipient">Recipient: </label>
                    <input type="text" id="d-recipient" name="d-recipient" placeholder="" required
                    <?php foreach ($result6 as $row) {echo "<option value='" . $row['name'] . "'";}?>>
                    <small>Error message</small>
                  </div>

                  <div class="form-control">
                    <label for="d-street">Outlet: </label>
                    <input type="text" id="d-outlets" name="d-outlets" placeholder="Austin" required 
                    <?php foreach ($result3 as $row) {echo "<option value='" . $row['outlets'] . "'";}?>>
                    <small>Error message</small>
                  </div>

                  <div class="form-control">
                    <label for="d-street">Street: </label>
                    <input type="text" id="d-street" name="d-street" placeholder="1, Jalan SS2 1C/29" required
                    <?php foreach ($result3 as $row) {echo "<option value='" . $row['street'] . "'";}?>>
                    <small>Error message</small>
                  </div>

                    <div class="form-control">
                      <label for="d-city">City: </label>
                      <input type="text" id="d-city" name="d-city" placeholder="Petaling Jaya" required
                      <?php foreach ($result3 as $row) {echo "<option value='" . $row['city'] . "'";}?>>
                      <small>Error message</small>
                    </div>

                  <div class="form-control">
                    <label for="d-state">State: </label>
                    <input type="text" id="d-state" name="d-state" placeholder="Selangor" required
                    <?php foreach ($result3 as $row) {echo "<option value='" . $row['state'] . "'";}?>>
                    <small>Error message</small>
                  </div>

                  <div class="form-control">
                    <label for="d-postcode">Postcode: </label>
                    <input type="number" id="d-postcode" name="d-postcode" placeholder="47301" required
                    <?php foreach ($result3 as $row) {echo "<option value='" . $row['postcode'] . "'";}?>>
                    <small>Error message</small>
                  </div>
    
                    <!--Delivery Date-->
                    <div class="form-control">
                      <label for="delivery-date">Select Delivery Date: </label>
                      <input type="date" id="delivery-date" name="delivery-date" value="<?php echo date('Y-m-d'); ?>" />
                      <small>Error message</small>
                  </div>
                </div>

                <div class="right-div">
                    <h2>Billing Information</h2>
                    <!--Billing Address-->
                    <div class="form-control">
                    <label for="b-recipient">Recipient: </label>
                    <input type="text" id="b-recipient" name="b-recipient" placeholder="" required
                    <?php foreach ($result6 as $row) {echo "<option value='" . $row['name'] . "'";}?>>
                    <small>Error message</small>
                  </div>

                    <div class="form-control">
                      <label for="b-street">Street: </label>
                      <input type="text" id="b-street" name="b-street" placeholder="1, Jalan SS2 1C/29" required
                      <?php foreach ($result3 as $row) {echo "<option value='" . $row['street'] . "'";}?>>
                      <small>Error message</small>
                    </div>
                    
                    <div class="form-control">
                      <label for="b-city">City: </label>
                      <input type="text" id="b-city" name="b-city" placeholder="Petaling Jaya" required
                      <?php foreach ($result3 as $row) {echo "<option value='" . $row['city'] . "'";}?>>
                      <small>Error message</small>
                    </div>
                    
                    <div class="form-control">
                      <label for="billing_state">State: </label>
                      <input type="text" id="b-state" name="b-state" placeholder="Selangor" required
                      <?php foreach ($result3 as $row) {echo "<option value='" . $row['state'] . "'";}?>>
                      <small>Error message</small>
                    </div>
                    
                    <div class="form-control">
                      <label for="b-postcode">Postcode: </label>
                      <input type="number" id="b-postcode" name="b-postcode" placeholder="47301" required
                      <?php foreach ($result3 as $row) {echo "<option value='" . $row['postcode'] . "'";}?>>
                      <small>Error message</small>
                    </div>

                    <!--Payment Method-->
                    <label for="payment-method">Payment Method: </label>
                        <select name="payment-method" id="payment-method">
                        <option value="Credit Card">Credit Card</option>
                        <option value="Debit Card">Debit Card</option>
                    </select> 
                    <br>
                </div>
              </div>

              <!--Products to be Checked Out-->
              <input type="hidden" id="products" name="products-checkout" value="">
                
              <!--Order Total-->
              <input type="hidden" id="total" name="order-total" value="">

              <script>
                // retrieve products to be checked out from local storage 'toCheckout'
                let productsCheckout = JSON.parse(localStorage.getItem('toCheckout'));
                if (!productsCheckout) {
                    productsCheckout = []; 
                }

                // assign products to be checked out to value of form input field 
                productsString = JSON.stringify(productsCheckout); 
                document.getElementById('products').value = productsString;

                // calculate order total 
                let total = 0;
                for (let i=0; i<productsCheckout.length; i++) {
                  total += productsCheckout[i].price;
                }

                // assign order total to value of form input field 
                document.getElementById('total').value = total // shipping fee = rm2
              </script>
              <!--Order Date --> 
              <input type="hidden" id="total" name="order-date" value="<?php echo date('Y-m-d'); ?>" />
              
              <!--Buttons-->
              <br>
              <div class="order-button">
                  <button type="submit" class="next-button" style="transform: translate(770px);">Continue</button>
              </div>
            </div>
          </form>

  </div>
  

<script src="../js/addToCart.js"></script>
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
    window.location = '../sales/products.php?outlet=' + selectedOutlet;
  }

  function purchasesummary() {
    var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../sales/purchasesummary.php?outlet=' + selectedOutlet;
  }

  form.addEventListener('submit', (e) => {
    let valid = formInputsCheck();

    if (!valid) {
        e.preventDefault(); // prevent form from submitting 
    }
    else {
      var selectedOutlet = '<?= $selectedOutlet ?>';
    window.location = '../sales/purchasesummary.php?outlet=' + selectedOutlet; // redirect to purchase summary page 
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

