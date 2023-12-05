const form = document.getElementById("ship&bill-form");

// assign each input field to a variable 
const dStreet = document.getElementById('d-street');
const dCity = document.getElementById('d-city');
const dState = document.getElementById('d-state');
const dPostcode = document.getElementById('d-postcode');

const bStreet = document.getElementById('b-street');
const bCity = document.getElementById('b-city');
const bState = document.getElementById('b-state');
const bPostcode = document.getElementById('b-postcode');

const deliveryDate = document.getElementById('delivery-date');
const cardNo = document.getElementById('card-number');
const cardName = document.getElementById('card-name');

// when form is submitted
// form.addEventListener('submit', (e) => {
//     let valid = formInputsCheck();

//     if (!valid) {
//         e.preventDefault(); // prevent form from submitting 
//     }
//     else {
//         window.location.href = "../sales/purchasesummary.php"; // redirect to purchase summary page 
//     }
// });

function formInputsCheck() { 
    let error = 0; // error count

    // assign values of input to variables
    const dStreet_value = dStreet.value;
    const dCity_value = dCity.value;
    const dState_value = dState.value;
    const dPostcode_value = dPostcode.value;

    const bStreet_value = bStreet.value;
    const bCity_value = bCity.value;
    const bState_value = bState.value;
    const bPostcode_value = bPostcode.value;

    const cardNo_value = cardNo.value;
    const cardName_value = cardName.value;

    // validate inputs with type="number"
    if (dPostcode_value.length != 5) {
        setError(dPostcode, 'Must contain exactly 5 digits');
        error += 1;
    }
    if (bPostcode_value.length != 5) {
        setError(bPostcode, 'Must contain exactly 5 digits');
        error += 1;
    }
    if (cardNo_value.length != 16) {
        setError(cardNo, 'Must contain exactly 16 digits with no hyphens');
        error += 1;
    }

    // validate street inputs
    if (!validStreet(dStreet_value)) {
        setError(dStreet, 'Can only contain alphanumeric values, spaces, commas, slashes and full stops');
        error += 1;
    }
    if (!validStreet(bStreet_value)) {
        setError(bStreet, 'Can only contain alphanumeric values, spaces, commas, slashes and full stops');
        error += 1;
    }

    // validate city, state and cardholder name
    if (!validText(dCity_value)) {
        setError(dCity, 'Can only contain alphabets and spaces');
        error += 1;
    }
    if (!validText(bCity_value)) {
        setError(bCity, 'Can only contain alphabets and spaces');
        error += 1;
    }
    if (!validText(dState_value)) {
        setError(dState, 'Can only contain alphabets and spaces');
        error += 1;
    }
    if (!validText(bState_value)) {
        setError(bState, 'Can only contain alphabets and spaces');
        error += 1;
    }
    if (!validName(cardName_value)) {
        setError(cardName, 'Can only contain alphabets, spaces, apostrophes, @ sign and dashes');
        error += 1;
    }

    // validate delivery date
    const deliveryDate_value = new Date(deliveryDate.value);
    let today = new Date();
    today.setDate(today.getDate()); 
    let dd = today.getDate();
    let mm = today.getMonth()+1;
    let yyyy = today.getFullYear();
    if (dd < 10) {
      dd = "0" + dd;
    }
    if (mm < 10) {
      mm = "0" + mm;
    }
    let formattedDate = dd + "/" + mm + "/" + yyyy;

    if (deliveryDate_value <= today) {
        setError(deliveryDate, 'Delivery date must be at least a day after today (' + formattedDate + ').'); 
        error += 1;
    }

    // return true or false to function caller 
    if (error == 0) {
        return true;
    }
    else {
        return false;
    }


    function setError(input, message) {
        const formControl = input.parentElement; // div with class="form-control"
        const small = formControl.querySelector('small');

        small.innerText = message; // add error message in small tag 
        formControl.className = "form-control error"; // add error class 
    }

    function validStreet(street) {
        const regex = /^[ A-Za-z0-9,./]*$/;
        return regex.test(street);
    }

    function validText(text) {
        const regex = /^[a-zA-Z\s]*$/;
        return regex.test(text);
    }

    function validName(name) {
        const regex = /^[ A-Za-z'@-]*$/;
        return regex.test(name);
    }
}