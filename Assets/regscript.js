function inputValidation(){

    var input = document.getElementById("name").value.trimStart();
    var length = input.length;

    if(length == 0){
        alert("Name cannot empty");
    }
    else if(length < 4 || length > 25){
        alert("Name must be between 4 and 25 characters"); //4-25
    }
    else{

        var input = document.getElementById("username").value.trim();
        var length = input.length;
        var regex = /^[a-zA-Z0-9]+$/;

        if(length == 0){
            alert("Username cannot empty");
        }
        else if (length < 6 || length > 9) {
            alert("Username must be between 6 and 16 characters"); //6-16
        } 
        else if(!regex.test(input)){
            alert("Username must contain only letters and numbers");
        }
        else{

            var input = document.getElementById("email").value.trim();
            var length = input.length
            var emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]+$/;

            if(length == 0){
                alert("Email cannot empty");
            }
            else if(!emailRegex.test(input)) {
                alert("Invalid email format");
            }
            else{

                var input = document.getElementById("age").value;
                var length = input.length

                if(length == 0){
                    alert("Age cannot empty");
                }
                else if(input < 17){
                    alert("Age must be above 17");
                }
                else if(input > 99){
                    alert("Invalid age");
                }
                else{

                    var input = document.getElementById("password").value.trim();
                    var length = input.length;

                    if(length == 0){
                        alert("Password cannot empty");
                    }
                    else if(length < 8){
                        alert("Minimum password length is 8");
                    }
                    else if(length > 16){
                        alert("Maximum password length is 16");
                    }
                    else{
                        alert("success");
                    }


                }
            }
        }
    }

    return false;
}