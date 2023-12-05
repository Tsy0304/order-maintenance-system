const form = document.getElementById('update-form');

// assign each input field to a variable 
const fname = document.getElementById('fname');
const lname = document.getElementById('lname');
const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirm_password');

// when register form is submitted
form.addEventListener('submit', (e) => {
    let valid = formInputsCheck();

    if (!valid) {
        e.preventDefault(); // prevent form from submitting 
    }

});

function formInputsCheck() {
    let error = 0; // error count 

    // assign values of input to variables
    const fname_value = fname.value;
    const lname_value = lname.value;
    const password_value = password.value;
    const confirmPassword_value = confirmPassword.value;

    // validate fname and lname 
    if (!validName(fname_value)) {
        setError(fname, 'Can only contain alphabets, spaces, apostrophes, @ sign and dashes');
        error += 1;
    }
    if (!validName(lname_value)) {
        setError(lname, 'Can only contain alphabets, spaces, apostrophes, @ sign and dashes');
        error += 1;
    }

    // validate password 
    if (!validPassword(password_value)) {
        setError(password, 'Must contain a minumum of 8 characters, at least one alphabet and one number');
        error += 1;
    }

    // check if both passwords are the same 
    if (confirmPassword_value != password_value) {
        setError(confirmPassword, 'Passwords do not match');
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
    
    function validName(name) {
        const regex = /^[ A-Za-z'@-]*$/; // regex to be checked against
        return regex.test(name);
    }
    
    function validPassword(password) {
        const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        return regex.test(password);
    }
}