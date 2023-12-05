<?php
include('../profile/auth.php');
?>
<!DOCTYPE html>
<html>
<title>Products</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/products.css" type="text/css">
<head>
  <link rel="icon" href="../img/book.png">
  <style>
      select{background-color: #008CB6;
        color:white;
        border-color:transparent;}
  </style>
</head>
<?php
if (isset($_GET['outlet'])) {
  $selectedOutlet = $_GET['outlet'];
  // Now you can use $selectedOutlet as needed
} else {
  // Handle the case when 'outlet' parameter is not set, or set a default value
  $selectedOutlet = 'd'; // Replace with your default value
}
$handler = mysqli_connect("localhost", "root", "", "capstone2");
$sql = "SELECT outlets FROM outlets"; // Replace "outlets_table" with the actual table name

$result = mysqli_query($handler, $sql);
$outlets = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
        <img class="my-cart cart-icon" src="../img/cart.svg" alt="cart">
        <a class="nav-list" onclick="phome()">Products<div class="nav-active"></div></a>
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
      <h1 style="margin-top: 130px;">Products</h1>
    <!--Filter-->
    <div id="ButtonContainer">
        <a href="#AllProducts"><button class="button active" onclick="filterSelection('all');">All Products</button></a>
        <a href="#Fiction"><button class="button" onclick="filterSelection('Fiction');">Fiction</button></a>
        <a href="#Non-Fiction"><button class="button" onclick="filterSelection('Non-Fiction');"> Non-Fiction</button></a>
        <input type="text" id="searchBarInput" onkeyup="searchFunction()" placeholder="Search for Product Name or Code ..">
        <svg style="height:24px; width:24px;transform: translate(-38px, 8px)" viewBox="0 0 24 24"  fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
        <label for="outlets">Outlets: &nbsp;</label>
        <select name="outlets" id="outlets" class="button">
        <?php
        foreach ($outlets as $outletData) {
            $outletName = $outletData['outlets'];
            $selected = ($outletName === $selectedOutlet) ? 'selected' : '';
            echo "<option value='$outletName' $selected>$outletName</option>";
        }
        ?>
        </select>
    </div>
    <!--Filter-->
    <!--Product List-->
    <div class="product-box" id="search1">
        <div class="product product-card filterDiv Fiction" id="search2">
            <div class="product-img">
                <img src="../book/Harrypotter1.png" class="thumbnail" alt="">
                <button class="card-btn addToCart" data-product-id="1">Add to cart</button>
            </div>
            <div class="description" id="search3">
                <h3 class="product-name">Harry Potter and the Sorcerers Stone</h3>
                <p class="product-code">Product Code: <span class="codeValue">HP001</span></p>
                <p class="price">RM<span class="priceValue">50.00</span></p>
            </div>
        </div>

        <div class="product product-card filterDiv Fiction">
            <div class="product-img">
                <img src="../book/Harrypotter2.png" class="thumbnail" alt="">
                <button class="card-btn addToCart" data-product-id="2">Add to cart</button>
            </div>
            <div class="description">
                <h3 class="product-name">Harry Potter and the Chamber of Secrets</h3>
                <p class="product-code">Product Code: <span class="codeValue">HP002</span></p>
                <p class="price">RM<span class="priceValue">50.00</span></p>
            </div>
        </div>

        <div class="product product-card filterDiv Fiction">
            <div class="product-img">
                <img src="../book/Harrypotter3.png" class="thumbnail" alt="">
                <button class="card-btn addToCart" data-product-id="3">Add to cart</button>
            </div>
            <div class="description">
                <h3 class="product-name">Harry Potter and the Prisoner of Azkaban</h3>
                <p class="product-code">Product Code: <span class="codeValue">HP003</span></p>
                <p class="price">RM<span class="priceValue">50.00</span></p>
            </div>
        </div> 
        
        <div class="product product-card filterDiv Fiction">
            <div class="product-img">
                <img src="../book/Harrypotter4.png" class="thumbnail" alt="">
                <button class="card-btn addToCart" data-product-id="4">Add to cart</button>
            </div>
            <div class="description">
                <h3 class="product-name">Harry Potter and the Goblet of Fire</h3>
                <p class="product-code">Product Code: <span class="codeValue">HP004</span></p>
                <p class="price">RM<span class="priceValue">50.00</span></p>
            </div>
        </div> 
        
        <div class="product product-card filterDiv Fiction">
            <div class="product-img">
                <img src="../book/Harrypotter5.png" class="thumbnail" alt="">
                <button class="card-btn addToCart" data-product-id="5">Add to cart</button>
            </div>
            <div class="description">
                <h3 class="product-name">Harry Potter and the Order of the Phoenix</h3>
                <p class="product-code">Product Code: <span class="codeValue">HP005</span></p>
                <p class="price">RM<span class="priceValue">50.00</span></p>
            </div>
        </div> 
        
        <div class="product product-card filterDiv Fiction">
            <div class="product-img">
                <img src="../book/Harrypotter6.png" class="thumbnail" alt="">
                <button class="card-btn addToCart" data-product-id="6">Add to cart</button>
            </div>
            <div class="description">
                <h3 class="product-name">Harry Potter and the Half Blood Prince</h3>
                <p class="product-code">Product Code: <span class="codeValue">HP006</span></p>
                <p class="price">RM<span class="priceValue">50.00</span></p>
            </div>
        </div>  

        <div class="product product-card filterDiv Fiction">
            <div class="product-img">
                <img src="../book/Harrypotter7.png" class="thumbnail" alt="">
                <button class="card-btn addToCart" data-product-id="7">Add to cart</button>
            </div>
            <div class="description">
                <h3 class="product-name">Harry Potter and the Deathly Hallows</h3>
                <p class="product-code">Product Code: <span class="codeValue">HP007</span></p>
                <p class="price">RM<span class="priceValue">50.00</span></p>
            </div>
        </div>  

        <div class="product product-card filterDiv Non-Fiction">
            <div class="product-img">
                <img src="../book/grumpybird.jpg" class="thumbnail" alt="">
                <button class="card-btn addToCart" data-product-id="8">Add to cart</button>
            </div>
            <div class="description">
                <h3 class="product-name">Grumpy Bird</h3>
                <p class="product-code">Product Code: <span class="codeValue">GB001</span></p>
                <p class="price">RM<span class="priceValue">40.00</span></p>
            </div>
        </div>

        <div class="product product-card filterDiv Non-Fiction">
            <div class="product-img">
                <img src="../book/Hickety.jpg" class="thumbnail" alt="">
                <button class="card-btn addToCart" data-product-id="5">Add to cart</button>
            </div>
            <div class="description">
                <h3 class="product-name">Hickory Dickory Dock</h3>
                <p class="product-code">Product Code: <span class="codeValue">HD001</span></p>
                <p class="price">RM<span class="priceValue">40.00</span></p>
            </div>
        </div>
      
        <div class="product product-card filterDiv Non-Fiction">
            <div class="product-img">
                <img src="../book/Knuffle.jpg" class="thumbnail" alt="">
                <button class="card-btn addToCart" data-product-id="9">Add to cart</button>
            </div>
            <div class="description">
                <h3 class="product-name">Knuffle Bunny</h3>
                <p class="product-code">Product Code: <span class="codeValue">KB001</span></p>
                <p class="price">RM<span class="priceValue">40.00</span></p>
            </div>
        </div>    
    
    </div>
    <div id="no-products">
        <img id="no-products-found" src="../img/noresults.png">
        <span>No products found.</span>
    </div>

</div>


<script>
function redirectToCart() {
    var selectedOutlet = document.getElementById("outlets").value;
    window.location = '../admin/cart.php?outlet=' + selectedOutlet;
  }

  function outlets() {
    var selectedOutlet = document.getElementById("outlets").value;
    window.location = '../admin/outlet.php?outlet=' + selectedOutlet;
  }


  function details() {
    var selectedOutlet = document.getElementById("outlets").value;
    window.location = '../admin/details.php?outlet=' + selectedOutlet;
  }

  function order() {
    var selectedOutlet = document.getElementById("outlets").value;
    window.location = '../admin/order.php?outlet=' + selectedOutlet;
  }

  function invoice() {
    var selectedOutlet = document.getElementById("outlets").value;
    window.location = '../admin/invoice.php?outlet=' + selectedOutlet;
  }

  function profile() {
    var selectedOutlet = document.getElementById("outlets").value;
    window.location = '../admin/profile.php?outlet=' + selectedOutlet;
  }

  function purchasehistory() {
    var selectedOutlet = document.getElementById("outlets").value;
    window.location = '../admin/purchasehistory.php?outlet=' + selectedOutlet;
  }

  function phome() {
    var selectedOutlet = document.getElementById("outlets").value;
    window.location = '../admin/products.php?outlet=' + selectedOutlet;
  }

  function book() {
    var selectedOutlet = document.getElementById("outlets").value;
    window.location = '../admin/book.php?outlet=' + selectedOutlet;
  }

  function staff() {
    var selectedOutlet = document.getElementById("outlets").value;
    window.location = '../admin/staff.php?outlet=' + selectedOutlet;
  }

filterSelection("all")
function filterSelection(c) { // Function for Product Categories
    var x, i;
    x = document.getElementsByClassName("filterDiv");
    if (c == "all") c = "";
    for (i = 0; i < x.length; i++) {
        removeClass(x[i], "show");
        if (x[i].className.indexOf(c) > -1) addClass(x[i], "show");
    }
    
}

function addClass(element, name) { // Function for adding Class used for filterSelection Function
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

function removeClass(element, name) { // Function for adding Class used for filterSelection Function
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

var btnContainer = document.getElementById("ButtonContainer"); 
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}

// Function to toggle between hidden and shown for the logout-box
function showLogoutDiv() {
  var x = document.getElementById("logout-box");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

// Function to check url and change the product categories accordingly
function checkurl() {
    if (window.location.href.indexOf('Fiction') > 0) {
        filterSelection('Fiction');
    } else if (window.location.href.indexOf('Non-Fiction') > 0) {
        filterSelection('Non-Fiction');
    } else if (window.location.href.indexOf('AllProducts') > 0) {
        filterSelection('all');
    }
}

// Search Bar function
function searchFunction() {
        document.location.href = "../admin/products.php#AllProducts";
        checkurl();
        var a, b, i, txtValue;
        var input = document.getElementById("searchBarInput");
        var filter = input.value.toUpperCase();
        var x = document.getElementsByClassName("product-name");
        var y = document.getElementsByClassName("product-card");
        var z = document.getElementsByClassName("codeValue");
        var count = 0;
        for (i = 0; i < x.length; i++) {
            a = x[i]
            b = z[i]
            txtValue = a.textContent || a.innerText;
            codeValue = b.textContent || b.innerText;
            if ((txtValue.toUpperCase().indexOf(filter) > -1) || (codeValue.toUpperCase().indexOf(filter) > -1)) {
                y[i].style.display = "";
                count += 1;
            } else {
                y[i].style.display = "none";
            }
        }
        if (count == 0) {
            document.getElementById("no-products").style.display = "block";
        }
        else {
            document.getElementById("no-products").style.display = "none";
        }
    }   
window.onload
</script>

<!--Add to Cart Function-->
<script src="../js/addToCart.js"></script>
</body>
</html>