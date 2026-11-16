
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

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    if (!validateForm()) return; // client side validation of form

    // submit request to server
    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            credentials: 'same-origin'
        });

        const data = await response.json();

        if (response.ok && data.success) {
            window.location.href = data.redirect;
            return;
        }

        setFormStatusBar(false, data.error || '://LOGIN-FAILED');
    } catch (err) {
        console.log(err);
        setFormStatusBar(false, '://NETWORK-ERROR');
    }
});