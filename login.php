


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="stylesheet" href="./Assets/logstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&family=Pixelify+Sans&display=swap" rel="stylesheet">
</head>

<body>

    <div class="top-bar align-center justify-center flex"> 
        <a class="top-text nunito">Binus Curcol</a>
    </div>

    <div class="form-div justify-center flex">
        <div class="mid-bar justify-center align-center flex">
            <form action="./Controller/login_auth.php" method="POST">
                <fieldset class="inputbox">
                    <input id="username" name="username" required="required" type="text">
                    <span class="nunito">Username</span>
                    <i></i>
                </fieldset>
                <br><br>
                <div class="inputbox">
                    <input id="password" name="password" required="required" autocomplete="off" type="password">
                    <span class="nunito">Password</span>
                    <i></i>
                </div>
                <br><br>
                <button class="btn nunito" onclick="return InputLength()">Login</button>
            </form>
    
        </div>

        <div class="reg-bar justify-center align-center flex">
            <p class="reg-txt nunito">already have an account? <a class="reg-but" href="register.php">register</a> here</p>
        </div>


    </div>

</body>
<script src="./Assets/logscript.js"></script>
</html>