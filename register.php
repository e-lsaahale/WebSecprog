<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <link rel="stylesheet" href="./Assets/regstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&family=Pixelify+Sans&display=swap" rel="stylesheet">
</head>

<body>

    <div class="top-bar align-center justify-center flex"> 
        <a class="nunito top-text">REGISTER</a>
    </div>

    <div>
        <div class="nunito mid-bar flex align-center justify-center">
            <form>
                <div class="input-group">
                    <input required="required" type="text" autocomplete="off" class="input">
                    <label class="user-label">Name</label>
                  </div>
                  <br>
                  <div class="input-group">
                    <input required="required" type="text" autocomplete="off" class="input">
                    <label class="user-label">Username</label>
                  </div>
                  <br>
                  <div class="input-group">
                    <input required="required" type="text" autocomplete="off" class="input">
                    <label class="user-label">Email</label>
                  </div>
                  <br>
                  <div class="input-group">
                    <input required="required" type="number" oninput="this.value=this.value.replace(/[^\d]/,'')" autocomplete="off" class="input">
                    <label class="user-label">Age</label>
                  </div>
                  <br>
                  <div class="input-group">
                    <input required="required" type="password" autocomplete="off" class="input">
                    <label class="user-label">Password</label>
                  </div>
                  <br><br>
                  <button class="btn nunito">Login</button>
            </form>
        </div>

        <div class="reg-bar justify-center align-center flex">
            <p class="reg-txt nunito">already have an account? <a class="reg-but" href="login.php">login</a> here</p>
        </div>

    </div>
    
    
</body>
</html>
