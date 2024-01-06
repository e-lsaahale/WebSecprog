<?php

    session_start();
    require "./Controller/func.php";

    if (!isset($_SESSION['login'])) {
        session_unset();
        session_destroy();
        header("Location: ./login.php");
        exit();
    }
    else{
        sesschk();
    }

    csrfgen();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posting Page</title>

    <link rel="stylesheet" href="Assets/mainstyle.css">

    <link rel="stylesheet" href="./Assets/sendstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&family=Pixelify+Sans&display=swap" rel="stylesheet">

    <script>
            function main() {
                var targetURL = 'main.php';
                window.location.href = targetURL;
        }
    </script>
</head>

<body>

    
    <div class="top-bar align-center flex"> 
        <div><a class="top-text nunito"> Create a post</a></div>
        <div><button class="exit-btn" onclick="main()">Main Page</button></div>
    </div>

    <div class="form-div justify-center flex">
        <div class="mid-bar justify-center align-center flex">
            <form action="./Controller/send_auth.php" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?>">
                <!-- <div class="input-container">
                    <input type="text" id="input" required="">
                    <label for="input" class="label">Cerita disini</label>
                    <div class="underline"></div>
                  </div> -->
                  <fieldset class="form-group form-textarea">
                    <label for="message">What is your story:</label>
                    <textarea id="message" name="message" rows="5" class="form-control" ></textarea>
                 </fieldset>
                 <!-- <fieldset class="form-group">
                    <label for="user_file">Attachment:</label>
                    <input id="user_file" name="user_file" type="file" placeholder="" class="form-control"">
                 </fieldset> -->
                <button class="btn nunito" onclick="return msgValidate()">Send</button>
            </form>
            <div class="reg-bar justify-center align-center flex">
                <form>
                <p class="reg-txt nunito"> <a class="reg-but" href="./Controller/exit.php">Terminate Program</a> here</p>
                </form>
            </div>
        </div>
    </div>
    
    
</body>
<script src="./Assets/sendscript.js"></script>
</html>