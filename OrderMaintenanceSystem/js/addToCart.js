// retrieve data from local storage
let productsInCart = JSON.parse(localStorage.getItem('shoppingCart')); // convert back to JavaScript array
if (!productsInCart) {
    productsInCart = []; // if cart is empty 
}

// assign elements to variable names
let parentElement = document.querySelector('#addItems');
let products = document.querySelectorAll('.product-card');
let closeCartList = document.querySelector('#closeButton');
let cartList = document.querySelector('.overlay');

// close shopping cart
function closeCart() {
    const cart = document.querySelector('.cart-list');
    cart.classList.toggle('hide');
    document.querySelector('body').classList.toggle('stopScrolling');
}

// open shopping cart 
const openCart = document.querySelector('.cart-icon');
openCart.addEventListener('click',() => {
    const cart = document.querySelector('.cart-list');
    cart.classList.toggle('hide');
    document.querySelector('body').classList.toggle('stopScrolling');
});

closeCartList.addEventListener('click', closeCart);
cartList.addEventListener('click', closeCart);

const calculateTotalPrice = function() {
    let sum = 0;
    productsInCart.forEach(item => {
        sum += item.price;
    });
    return sum;
}

const updateShoppingCart = function() {
    // data is stored as JSON string in local storage
    localStorage.setItem('shoppingCart',JSON.stringify(productsInCart));
    // check if there are products in cart 
    if (productsInCart.length > 0) {
        let result = productsInCart.map(product => {
            return `
            <li class = "addItem">
                <img src="${product.image}">
                <div>
                    <h5>${product.name}</h5>
                    <h6>
                        ${product.code}
                        <br>
                        RM${product.price.toFixed(2)}
                    </h6>
                    <div>
                        <button class="minus-button" data-id="${product.id}">-</button>
                        <span class="product-qty">${product.qty}</span>
                        <button class="plus-button" data-id="${product.id}">+</button>
                    </div>
                </div>
            </li>
            `
        });
        parentElement.innerHTML = result.join(''); // map function returns an array
        document.querySelector('.checkout').classList.remove('hidden');
    } 
    else {
        document.querySelector('.checkout').classList.add('hidden');
        parentElement.innerHTML = '<h4 class="empty">Your shopping cart is empty.</h4>';
    }
}

function updateProductsInCart(product) {
    // check if product is in cart 
    for (let i = 0; i < productsInCart.length; i++) {
        if (productsInCart[i].id == product.id) {
            productsInCart[i].qty += 1;
            productsInCart[i].price = productsInCart[i].basePrice * productsInCart[i].qty;
            return;
        }
    }

    // if product does not exist in cart
    productsInCart.push(product);
}

// eventListener 
products.forEach(item => {
    item.addEventListener('click', (e) => {
        // call back function 
        if (e.target.classList.contains('addToCart')) {
            // access product details
            const productId = e.target.dataset.productId;
            const productName = item.querySelector('.product-name').innerHTML; 
            const productCode = item.querySelector('.codeValue').innerHTML;
            const productPrice = item.querySelector('.priceValue').innerHTML;
            const productImage = item.querySelector('img').src;

            // put all product details into an object 
            let product = {
                id: productId,
                name: productName,
                code: productCode,
                image: productImage,
                qty: 1,
                price: +productPrice, // convert from string to integer
                basePrice: +productPrice,
            }

            // call functions
            updateProductsInCart(product);
            updateShoppingCart();
        }
    });
});

parentElement.addEventListener('click', (e) => {
    // check if event comes from plus or minus button
    const isPlusButton = e.target.classList.contains('plus-button');
    const isMinusButton = e.target.classList.contains('minus-button');

    if (isPlusButton || isMinusButton) {
        for (let i = 0; i < productsInCart.length; i++) {
            if (productsInCart[i].id === e.target.dataset.id) {
                if (isPlusButton) {
                    productsInCart[i].qty += 1;
                } 
                else if (isMinusButton) {
                    productsInCart[i].qty -= 1;
                }
                productsInCart[i].price = productsInCart[i].basePrice * productsInCart[i].qty;
            }
            if (productsInCart[i].qty < 1) {
                // remove product from cart if qty < 1
                productsInCart.splice(i, 1);
            }
        }
        updateShoppingCart();
    }
});

// when data is retrieved from local storage, HTML code of the shopping cart needs to be updated
updateShoppingCart();
