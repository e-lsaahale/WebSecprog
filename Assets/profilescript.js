function statusValidate(){

    var input = document.getElementById("status").value.trim();
    var length = input.length;

    if(length > 30){
        alert("Maximum massage character is 30 characters");
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