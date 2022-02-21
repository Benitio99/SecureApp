
let passwordLength, alphaUpper, alphaLower, numeric, specialChars, noWords, okPassword, passwordMatch, submitButton;
let checks, goodChars;
let firstPassword, secondPassword;
const CHECKSGOOD = 7;
const PASSWORDLENGTH = 8;

function setAttributes() {
    passwordLength = document.getElementById("passwordLength");
    alphaUpper = document.getElementById("alphabetUpper");
    alphaLower = document.getElementById("alphabetLower");
    numeric = document.getElementById("numeric");
    specialChars = document.getElementById("specialChars");
    noBadChars = document.getElementById("noBadChars");
    noWords = document.getElementById("noWords");
    okPassword = document.getElementById("okPassword");
    passwordMatch = document.getElementById("passwordMatch");
    submitButton = document.getElementById("submit");
}
function disableInput(element) {
    element.setAttribute("disabled", "true");
}
function enableInput(element) {
    element.removeAttribute("disabled");
}
function setValueToTrue(element) {
    enableInput(element);
    element.setAttribute("checked", "true");
    disableInput(element);
}
function setValueToFalse(element) {
    enableInput(element);
    element.removeAttribute("checked");
    disableInput(element);
}
function checkPasswordComplexity(password) {
    firstPassword = password;
    setAttributes();
    goodChars = 0;
    console.log("checking pass complexity");
    checks = 0;

    if (checkLength(firstPassword)) {
        setValueToTrue(passwordLength);
        checks++;
    }
    else {
        setValueToFalse(passwordLength);
    }
    if (checkAlphaUpper(firstPassword)) {
        setValueToTrue(alphaUpper);
        checks++;
    }
    else {
        setValueToFalse(alphaUpper);
    }
    if (checkAlphaLower(firstPassword)) {
        setValueToTrue(alphaLower);
        checks++;
    }
    else {
        setValueToFalse(alphaLower);
    }
    if (checkNumeric(firstPassword)) {
        setValueToTrue(numeric);
        checks++;
    }
    else {
        setValueToFalse(numeric);
    }
    if (checkSpecialChars(firstPassword)) {
        setValueToTrue(specialChars);
        checks++;
    }
    else {
        setValueToFalse(specialChars);
    }
    if (checkBadChars(firstPassword)) {
        setValueToTrue(noBadChars);
        checks++;
    }
    else {
        setValueToFalse(noBadChars);
    }
    /*
    if (checkNoWords(firstPassword)){
        setValueToTrue(noWords);
        checks++;
    }
    else {
        setValueToFalse(noWords);
    }
    */
    if (checks === 6) {
        return true;
    }
    else {
        return false;
    }
    console.log("checks = " + checks);
}
function checkPasswordsMatch(password) {
    secondCheck = checks;
    secondPassword = password;
    console.log("checking matching password");

    if (checkPasswordMatch(secondPassword, firstPassword)) {
        setValueToTrue(passwordMatch);
        secondCheck++;
    }
    else {
        setValueToFalse(passwordMatch);
    }
    if (secondCheck == CHECKSGOOD) {
        setValueToTrue(okPassword);
        enableInput(submitButton);
    }
    else {
        setValueToFalse(okPassword);
        disableInput(submitButton);
    }
    console.log("checks = " + secondCheck);
}
function checkLength(password) {
    if (password.length >= PASSWORDLENGTH) {
        return true;
    }
    else {
        return false;
    }
}
function checkAlphaUpper(password) {
    let charCode, i, len, alpha;
    alpha = false;

    for (i = 0, len = password.length; i < len; i++) {
        charCode = password.charCodeAt(i);
        if (charCode > 64 && charCode < 91) {
            alpha = true;
            goodChars++;
        }
    }
    return alpha;
}
function checkAlphaLower(password) {
    let charCode, i, len, alpha;
    alpha = false;

    for (i = 0, len = password.length; i < len; i++) {
        charCode = password.charCodeAt(i);
        if (charCode > 96 && charCode < 123) {
            alpha = true;
            goodChars++;
        }
    }
    return alpha;
}
function checkNumeric(password) {
    let charCode, i, len, numeric;
    numeric = false;

    for (i = 0, len = password.length; i < len; i++) {
        charCode = password.charCodeAt(i);
        if (charCode > 47 && charCode < 58) {
            numeric = true;
            goodChars++;
        }
    }
    return numeric;
}
function checkSpecialChars(password) {
    const specials = [33, 63, 64, 95, 126];
    let charCode, i, len, special;
    special = false;

    for (i = 0, len = password.length; i < len; i++) {
        charCode = password.charCodeAt(i);
        if (specials.includes(charCode)) {
            special = true;
            goodChars++;
        }
    }
    return special;
}
//todo refactor later
function checkBadChars(password) {
    const BADCHARS = [34, 39, 47, 59, 60, 62, , 91, 93, 123, 125,];
    let charCode, i, len, badChar;
    badChar = true;
    len = password.length;
    if (len > 0) {
        for (i = 0, len; i < len; i++) {
            charCode = password.charCodeAt(i);
            if ((BADCHARS.includes(charCode))) {
                badChar = false;
            }
        }
    }
    return badChar;
}
function checkNoWords(password) {
    return false;
}
function checkPasswordMatch(password, passwordTwo) {
    if (password === passwordTwo) {
        return true;
    }
    else {
        return false;
    }
}

exports.checkLength = checkLength;
exports.checkAlphaUpper = checkAlphaUpper;
exports.checkAlphaLower = checkAlphaLower;
exports.checkNumeric = checkNumeric;
exports.checkSpecialChars = checkSpecialChars;
exports.checkBadChars = checkBadChars;
exports.checkPasswordMatch = checkPasswordMatch;
exports.checkPasswordComplexity = checkPasswordComplexity;
