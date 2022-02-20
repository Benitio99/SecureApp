function processInput(input) {
    sanitise(input);
    formatString(input);
}

function sanitise(htmlString) {
    let badChars = ["<", ">", ";", "/", "{", "}", "[", "]", '"', "'"];
    for (let i = 0; i < htmlString.length; i++) {
        let currentLetter = htmlString.charAt(i);
        if (badChars.includes(currentLetter)) {
            htmlString = htmlString.replace(currentLetter, "&#" + htmlString.charCodeAt(currentLetter) + ";");
        }
    }
    console.log(htmlString);
    return htmlString;
}

function formatString(input) {
    try {
        if (!(typeof input === "string")) {
            throw "TypeError";
        }
    }
    catch (error) {
        console.error("Type is not a valid string: " + error);
    }
}