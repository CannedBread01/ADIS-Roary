
const form = document.getElementById("form_register")
const user_element = document.getElementById("name")
const pwd_element = document.getElementById("pwd_original")
const pwd_confirm_element = document.getElementById("pwd_confirm")
const statusBar = document.getElementById("status_bar")


function setFormStatusBar(isValid, message){
    statusBar.classList.toggle("status-bar-normal", isValid);
    statusBar.classList.toggle("status-bar-error", !isValid);
    statusBar.textContent = message;
}

function validateForm(){
    // check if both password are the same
    pwd_confirm_element.setCustomValidity(
        pwd_confirm_element.value !== pwd_element.value ? 'Passwords do not match.' : ''
    );

    // check fields in order and report the first problem
    if (user_element.validity.valueMissing || user_element.validity.patternMismatch) {
        setFormStatusBar(false, "://USR-ONLY-ALPHANUMERIC");
        return false;
    }
    // check password length
    if (pwd_element.validity.valueMissing || pwd_element.validity.tooShort) {
        setFormStatusBar(false, "://PWD-TOO-SHORT");
        return false;
    }
    // check matching passwords
    if (pwd_confirm_element.validity.customError) {
        setFormStatusBar(false, "://PWD-NOT-MATCH");
        return false;
    }

    setFormStatusBar(true, "://READY");
    return true;
}

[user_element, pwd_element, pwd_confirm_element].forEach(element => {
    element.addEventListener('input', validateForm);
});

form.addEventListener('submit', (e) => {
    if (!validateForm()) e.preventDefault();
});