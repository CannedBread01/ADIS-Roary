
const roar_container = document.getElementById("roar_container")
const message_form = document.getElementById("message_form")
const message_input = document.getElementById("message")
const statusBar = document.getElementById("status_bar")
const decor_set = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz.,;:#'!/?()+*-_<>="

roars = []
let currentUsername = "";

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

function createPostCard(item){
    const card = document.createElement("div");
    card.classList.add("flex-container");
    card.classList.add("panel");

    const content = document.createElement("div");

    const decorStripe = document.createElement("div");
    decorStripe.classList.add("vertical");
    decorStripe.classList.add("message-decor");
    decorStripe.innerHTML = item.decor_string


    const nameParagraph = document.createElement("p");
    nameParagraph.classList.add("username");
    let name = item.name;
    if (item.name === currentUsername) name += " (You)"
    nameParagraph.innerText = name;

    const messageParagraph = document.createElement("p");
    messageParagraph.innerText = item.message;

    content.appendChild(nameParagraph);
    content.appendChild(messageParagraph);

    card.appendChild(content);
    card.appendChild(decorStripe);
    return card;
}

function updateDisplayedMessages(){
    roar_container.innerHTML = "";
    roars.forEach(roar => {
        roar_container.appendChild(createPostCard(roar));
    })
    roar_container.scrollTop = roar_container.scrollHeight;
}

function isMessageValid(data){
    return data.name.trim() !== "" && data.message.trim() !== "";
}

function handleOnChangedMessage(){
    const data = Object.fromEntries(new FormData(message_form));
    const isValid = isMessageValid(data);

    setStatusBar(isValid, isValid ? "::BROADCAST-READY::" : "::INCOMPLETE-INPUT::");
}

function submitMessage(){
    handleOnChangedMessage();
    // check if form is valid (has username & a message)
    let data = undefined
    try{
        const form = new FormData(message_form)
        data = Object.fromEntries(form)
    }
    catch(e){
        return false;
    }
    console.log(data);
    if(!isMessageValid(data)){
        return false;
    }
    // update logged messages
    message_input.value = "";
    data.decor_string = createRandomDecorString(4)
    roars.push(data)
    currentUsername = data.name
    updateDisplayedMessages()
    return false;
}

if(message_form != null) message_form.addEventListener("input", handleOnChangedMessage);

// handling dummy data for testing
dummy_roars = [
    {
        name: "NullPointerEx",
        message: "Building a custom CLI tool to parse ambient network chatter. If you see glitch artifacts in your terminal feed, that's just my indexer running.",
        decor_string: createRandomDecorString(4)
    },
    {
        name: "SyntaxError_X",
        message: "Refactored 500 lines of spaghetti code into a clean, recursive micro-service. No memory leaks detected. The system finally breathes.",
        decor_string: createRandomDecorString(4)
    },
    {
        name: "RootAccessOnly",
        message: "Overclocked my local workstation kernel to push real-time neural network rendering. The heat sinks are glowing green, but the frame rate is unmatched.",
        decor_string: createRandomDecorString(4)
    },
]

roars = roars.concat(dummy_roars)
updateDisplayedMessages()





