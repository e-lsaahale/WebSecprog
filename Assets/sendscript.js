function msgValidate(){

    var input = document.getElementById("message").value.trim();
    var length = input.length;

    if(length == 0){
        alert("Message cannot empty");
    }
    else if(length < 5 || length > 150){
        alert("Minimum massage character is 5 characters");
    }
    else if(length > 150){
        alert("Maximum massage character is 150 characters");
    }
    else{
        return true;
    }
    return false;
}

const urlParams = new URLSearchParams(window.location.search);
const errorParam = urlParams.get('error');

if (errorParam === '1') {
    alert("Story has not been sent. Please try again. :(");

    const newUrl = window.location.pathname;
    history.replaceState({}, document.title, newUrl);
}