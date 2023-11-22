function InputLength() {

    var usnInput = document.getElementById("username").value;
    var usnLength = usnInput.length;

    var passInput = document.getElementById("password").value;
    var passLength = passInput.length

    if(usnLength == 0){
        alert("Username cannot be empty");
        return false;
    }
    else{
        if(usnLength < 6 || usnLength > 16) {
            alert("Username must be between 6 and 16 characters");
            return false;
        }
        else if(passLength == 0) {
            alert("Password cannot be empty");
            return false;
        }
    }
    return true;
}

const urlParams = new URLSearchParams(window.location.search);
const errorParam = urlParams.get('error');

if (errorParam === '1') {
    alert("Invalid username or password");

    const newUrl = window.location.pathname;
    history.replaceState({}, document.title, newUrl);
}