
const roar_container = document.getElementById("roar_container")
const message_form = document.getElementById("message_form")
const message_input = document.getElementById("message")
const statusBar = document.getElementById("status_bar")
const decor_set = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz.,;:#'!/?()+*-_<>="

function setStatusBar(isValid, message){
    if(statusBar == null) return;

    statusBar.classList.toggle("status-bar-normal", isValid);
    statusBar.classList.toggle("status-bar-error", !isValid);
    statusBar.textContent = message;
}

function createRandomDecorString(length){
    let decorString = "";
    for(let i = 0; i < length; i++) {
        decorString += decor_set[Math.floor(Math.random()*decor_set.length)];
    }
    return decorString;
}

function decorateMessages(){
    document.querySelectorAll("#roar_container .message-decor").forEach(decorStripe => {
        decorStripe.textContent = createRandomDecorString(4);
    });
    roar_container.scrollTop = roar_container.scrollHeight;
}

function isMessageValid(){
    return message_input.value.trim() !== "";
}

function handleOnChangedMessage(){
    const isValid = isMessageValid();
    setStatusBar(isValid, isValid ? "::BROADCAST-READY::" : "::INCOMPLETE-INPUT::");
}

async function submitMessage(e){
    e.preventDefault();
    if(!isMessageValid()){
        setStatusBar(false, "::INCOMPLETE-INPUT::");
        return;
    }

    try {
        const response = await fetch(message_form.action, {
            method: "POST",
            body: new FormData(message_form),
            credentials: "same-origin"
        });

        if (response.redirected) {
            window.location.href = response.url;
            return;
        }

        const data = await response.json();

        if (response.ok && data.success) {
            window.location.reload();
            return;
        }

        setStatusBar(false, data.error || "::BROADCAST-FAILED::");
    } catch (err) {
        console.log(err);
        setStatusBar(false, "::NETWORK-ERROR::");
    }
}

if(message_form != null) {
    message_form.addEventListener("input", handleOnChangedMessage);
    message_form.addEventListener("submit", submitMessage);
}

decorateMessages();
