const form = document.getElementById("form_login")
const user_element = document.getElementById("name")
const pwd_element = document.getElementById("pwd_original")
const statusBar = document.getElementById("status_bar")


function setFormStatusBar(isValid, message){
    statusBar.classList.toggle("status-bar-normal", isValid);
    statusBar.classList.toggle("status-bar-error", !isValid);
    statusBar.textContent = message;
}

function validateForm(){


    // check fields in order and report the first problem
    if (user_element.validity.valueMissing) {
        setFormStatusBar(false, "://USR-MISSING");
        return false;
    }
    // check password length
    if (pwd_element.validity.valueMissing) {
        setFormStatusBar(false, "://PWD-MISSING");
        return false;
    }

    setFormStatusBar(true, "://READY");
    return true;
}

[user_element, pwd_element].forEach(element => {
    element.addEventListener('input', validateForm);
});

form.addEventListener('submit', (e) => {
    if (!validateForm()) e.preventDefault();

});
