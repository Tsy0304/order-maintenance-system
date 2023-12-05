
// retrieve data from local storage
let productsInCart1 = JSON.parse(localStorage.getItem('shoppingCart')); // convert back to JavaScript array
if (!productsInCart1) {
    productsInCart1 = []; // if cart is empty 
}

// assign elements to variable names
let table = document.getElementById('cart-table1');
let quantity = document.getElementsByClassName('product-qty');

// assign elements to variable names
let parentElement1 = document.querySelector('#addItems');
let products1 = document.querySelectorAll('.product-card');
let closeCartList1 = document.querySelector('#closeButton');
let cartList1 = document.querySelector('.overlay');

// clear local storage when cart.html page refreshes
function refresh() {
    // clear local storage when cart.html page refreshes
    window.localStorage.removeItem('toCheckout');

    // uncheck checkboxes that are checked
    let checkboxes = document.querySelectorAll('.checkbox');
    for (let checkbox of checkboxes) {
       checkbox.checked = false; 
    }
}

// update shopping cart in navigation table 
const updateShoppingCart1 = function() {
    // data is stored as JSON string in local storage
    localStorage.setItem('shoppingCart',JSON.stringify(productsInCart1));
    // check if there are products in cart 
    if (productsInCart1.length > 0) {
        let result = productsInCart1.map(product => {
            return `
            <li class = "addItem">
                <img src="${product.image}">
                <div>
                   ${product.name}
                   ${product.code}
                   RM${product.price.toFixed(2)}
                        <button class="minus-button" data-id="${product.id}">-</button>
                        <span class="product-qty">${product.qty}</span>
                        <button class="plus-button" data-id="${product.id}">+</button>
                </div>
            </li>
            `
        });
        parentElement1.innerHTML = result.join(''); // map function returns an array
        document.querySelector('.checkout').classList.remove('hidden');
    } 
    else {
        document.querySelector('.checkout').classList.add('hidden');
        parentElement1.innerHTML = '<h4 class="empty">Your shopping cart is empty.</h4>';
        document.getElementsByClassName('cart-list').style.overflow = "hidden"; // hide scrollbar
    }
}

function minusQuantity(productId) {
    // find index of product in local storage 'shoppingCart' 
   let index = -1;
   let product = {};
   for (let i=0; i<productsInCart1.length; i++) {
       if (productsInCart1[i].id == productId) {
            product = productsInCart1[i]; 
            index = productsInCart1.indexOf(product);
       }
   }

    // min quantity = 1 
    if (productsInCart1[index].qty < 2) {
        // check if checkbox is checked 
        let checkbox = document.getElementById('checkbox' + productId);
        let selectedItems = [];
        if (checkbox.checked) {
            selectedItems = JSON.parse(localStorage.getItem('toCheckout'));
            for (let i=0; i<selectedItems.length; i++) {
                if (selectedItems[i].id == productId) {
                    let item = selectedItems[i];
                    let index1 = selectedItems.indexOf(item);
                    checkbox.click(); // manually click checkbox 
                    selectedItems.splice(index1, 1);
                    localStorage.setItem('toCheckout',JSON.stringify(selectedItems));
                }
            }
        }

        // remove row from table 
        let row = document.getElementById("rowid" + productId);
        row.parentNode.removeChild(row);

        productsInCart1.splice(index, 1);
    }
    else {
        productsInCart1[index].qty -= 1;
        productsInCart1[index].price = productsInCart1[index].basePrice * productsInCart1[index].qty;

        // check if checkbox is checked 
        let checkbox = document.getElementById('checkbox' + productId);
        let selectedItems = [];
        if (checkbox.checked) {
            selectedItems = JSON.parse(localStorage.getItem('toCheckout'));
            for (let i=0; i<selectedItems.length; i++) {
                if (selectedItems[i].id == productId) {
                    let item = selectedItems[i];
                    item.qty = productsInCart1[index].qty;
                    item.price = productsInCart1[index].price;
                    localStorage.setItem('toCheckout',JSON.stringify(selectedItems));
                }
            }
        }

        // redisplay quantity and price 
        let quantity = document.getElementById('quantitytd' + productId);
        let price = document.getElementById('subtotaltd' + productId);
        quantity.innerHTML = "<div><button class='minus-button' onclick='minusQuantity(" + productsInCart1[index].id + ")' data-id='" + productsInCart1[index].id + "'>-</button><span class='product-qty'>" + productsInCart1[index].qty + "</span><button class='plus-button' onclick='plusQuantity(" + productsInCart1[index].id + ")' data-id='" + productsInCart1[index].id + "'>+</button></div>";
        price.innerHTML = "RM" + productsInCart1[index].price.toFixed(2);
    }

    updateShoppingCart1(); 
}

function plusQuantity(productId) {
    // find index of product in local storage 'shoppingCart' 
   let index = -1;
   let product = {};
   for (let i=0; i<productsInCart1.length; i++) {
       if (productsInCart1[i].id == productId) {
            product = productsInCart1[i]; 
            index = productsInCart1.indexOf(product);
       }
   }
   
    productsInCart1[index].qty += 1;
    productsInCart1[index].price = productsInCart1[index].basePrice * productsInCart1[index].qty;

    // check if checkbox is checked 
    let checkbox = document.getElementById('checkbox' + productId);
    let selectedItems = [];
    if (checkbox.checked) {
        selectedItems = JSON.parse(localStorage.getItem('toCheckout'));
        for (let i=0; i<selectedItems.length; i++) {
            if (selectedItems[i].id == productId) {
                let item = selectedItems[i];
                item.qty = productsInCart1[index].qty;
                item.price = productsInCart1[index].price;
                localStorage.setItem('toCheckout',JSON.stringify(selectedItems));
            }
        }
    }

    /// redisplay quantity and price 
    let quantity = document.getElementById('quantitytd' + productId);
    let price = document.getElementById('subtotaltd' + productId);
    quantity.innerHTML = "<div><button class='minus-button' onclick='minusQuantity(" + productsInCart1[index].id + ")' data-id='" + productsInCart1[index].id + "'>-</button><span class='product-qty'>" + productsInCart1[index].qty + "</span><button class='plus-button' onclick='plusQuantity(" + productsInCart1[index].id + ")' data-id='" + productsInCart1[index].id + "'>+</button></div>";
    price.innerHTML = "RM" + productsInCart1[index].price.toFixed(2);
    
    updateShoppingCart1();
}

function removeFromCart(productId) {
    // find index of product in local storage 'shoppingCart' 
    let index = -1;
    let product = {};
    for (let i=0; i<productsInCart1.length; i++) {
        if (productsInCart1[i].id == productId) {
            product = productsInCart1[i]; 
            index = productsInCart1.indexOf(product);
        }
    }

    // check if checkbox is checked
    let checkbox = document.getElementById('checkbox' + productId);
    let selectedItems = [];
    if (checkbox.checked) {
        selectedItems = JSON.parse(localStorage.getItem('toCheckout'));
        for (let i=0; i<selectedItems.length; i++) {
            if (selectedItems[i].id == productId) {
                let item = selectedItems[i];
                let index1 = selectedItems.indexOf(item);
                checkbox.click(); // manually click checkbox 
                selectedItems.splice(index1, 1);
                localStorage.setItem('toCheckout',JSON.stringify(selectedItems));
            }
        }
    }

    // remove row from table 
    let row = document.getElementById("rowid" + productId);
    row.parentNode.removeChild(row);

    productsInCart1.splice(index, 1);
    updateShoppingCart1();
}

// dynamically populate table with products in cart 
let content = "";
for (let i=0; i < productsInCart1.length; i++) {
    content += "<tr id='rowid" + productsInCart1[i].id + "'>";
    content += "<td><input type='checkbox' class ='checkbox' id='checkbox" + productsInCart1[i].id + "' name='checkbox" + productsInCart1[i].id + "' value='" + productsInCart1[i].id + "'></td>";
    content += "<td><div class='item'><img src='" + productsInCart1[i].image + "'><div>" + productsInCart1[i].name + "<br><small>" + productsInCart1[i].code + "</small>" + "<br><br><small>Price: RM" + productsInCart1[i].basePrice.toFixed(2) + "</small></div></div></td>"; 
    content += "<td></td>";
    content += "<td></td>";
    content += "<td id='quantitytd" + productsInCart1[i].id + "'><div><button class='minus-button' onclick='minusQuantity(" + productsInCart1[i].id + ")' data-id='" + productsInCart1[i].id + "'>-</button><span class='product-qty'>" + productsInCart1[i].qty + "</span><button class='plus-button' onclick='plusQuantity(" + productsInCart1[i].id + ")' data-id='" + productsInCart1[i].id + "'>+</button></div></td>"; 
    content += "<td id='subtotaltd" + productsInCart1[i].id + "'>RM" + productsInCart1[i].price.toFixed(2) + "</td>";
    content += "<td><a href='#' onclick='removeFromCart(" + productsInCart1[i].id + ")'>Remove</a></td>";  
    content += "<td></td>"; 
    content += "</tr>";
}
table.innerHTML = content;

parentElement1.addEventListener('click', (e) => {
    // check if event comes from plus or minus button
    const isPlusButton = e.target.classList.contains('plus-button');
    const isMinusButton = e.target.classList.contains('minus-button');

    if (isPlusButton || isMinusButton) {
        for (let i = 0; i < productsInCart1.length; i++) {
            if (productsInCart1[i].id === e.target.dataset.id) {
                if (isPlusButton) {
                    productsInCart1[i].qty += 1;
                } 
                else if (isMinusButton) {
                    productsInCart1[i].qty -= 1;
                }
                productsInCart1[i].price = productsInCart1[i].basePrice * productsInCart1[i].qty;
            }
            if (productsInCart1[i].qty < 1) {
                // remove product from cart if qty < 1
                productsInCart1.splice(i, 1);
            }
        }
        updateShoppingCart1();
    }
});

let selectedProducts = [];
let checkboxes = document.querySelectorAll('.checkbox');

for (let checkbox of checkboxes) {
    checkbox.addEventListener('click', function(){
        if (this.checked === true) {
            for (let i = 0; i < productsInCart1.length; i++) {
                if (productsInCart1[i].id == this.value) {
                    let product = productsInCart1[i];
                    selectedProducts.push(product);
                    localStorage.setItem('toCheckout',JSON.stringify(selectedProducts));
                }
            }
        } 
        else { // remove item from array if unchecked
            for (let i = 0; i < productsInCart1.length; i++) {
                if (productsInCart1[i].id == this.value) {
                    let product = productsInCart1[i];
                    let index = selectedProducts.indexOf(product);
                    selectedProducts.splice(index, 1);
                    localStorage.setItem('toCheckout',JSON.stringify(selectedProducts));
                }
            }
        }
    })
}

// display message if no checkbox is checked 
// function checkboxChecked() {
//     const valid = localStorage.getItem('toCheckout');
//     if (valid) {
//         let selectedItems = JSON.parse(localStorage.getItem('toCheckout'));
//         if (selectedItems.length != 0) {
//             // redirect to checkout page if at least one product is selected 
//             var selectedOutlet = document.getElementById("outlets").value;
//             window.location = `../sales/checkout.php?outlet=${selectedOutlet}`;
//         }
//         else {
//             alert("Please select at least one product to be checked out.")
//         }
//     }
//     else {
//         alert("Please select at least one product to be checked out.")
//     }
// }













