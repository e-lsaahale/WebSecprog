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
    <link rel="stylesheet" href="Assets/mainstyle.css">
    <title>Profile</title>
    <style>

        .profile_config {
            display: flex;
            align-items: center;
            height: 800px;
            justify-content: center;
        }
        .profile {
            display: flex;
            background-color: lightgray;
            width: 600px;
            height: 600px;
            border-radius: 15px;
        }
        .status {
            display: flex;
            flex-direction: row;
        }

        .status_text {
            margin-right: 30px;
        }
        .profile_text {
            margin-left: 30px;
        }
    
        .username {
            display: flex;
            flex-direction: row;
            font-size: 15px;
            font-weight: bold;
            margin-left: 20px;
            margin-bottom: 10px;
        }

        .message{
            display: flex;
            flex-direction: row;
            font-size: 12px;
            margin-left: 10px;
            margin-bottom: 10px;
        }

        .user_profile_text {
            font-size: 50px;
            color: aqua;
        }

    </style>
    <script>
        function main() {
            var targetURL = 'main.php';
            window.location.href = targetURL;
        }

        // function statusValidation(){

        //     var input = document.getElementById("status").value.trim();
        //     var length = input.length;

        //     if(length > 100){
        //         alert("Message can't be more than 100 characters");
        //     }else{
        //         return true;
        //     }
        //     return false;
        // }
    </script>
</head>
<body>
    <div class="top-bar" >
        <a class="bcc-txt">Binus Curcol</a>
        <div class="buttons">
            <button class="exit-btn" onclick="main()"> Main Page</button>
        </div>
    </div>
    
    <div class="container">
        <div class="box">
            <div class="user_profile_text">USER PROFILE</div>
            <?php
                // session_start();
                require "./Controller/conn.php";
                $iduser = $_SESSION['user_id'];
                $stmt = $conn->prepare("SELECT * FROM users WHERE id=$iduser");
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()){
            ?>
                <div class="status">
                    <div class="username">Full Name :</div>
                    <div class="username"><?php echo $row["Name"];?></div>
                </div>
                
                <div class="status">
                    <div class="username">Username :</div>
                    <div class="username"><?php echo $row["Username"];?></div>
                </div>

                <div class="status">
                    <div class="username">Email :</div>
                    <div class="username"><?php echo $row["Email"];?></div>
                </div>

                <div class="status">
                    <div class="username">Age :</div>
                    <div class="username"><?php echo $row["Age"];?></div>
                </div>

                <div class="status">
                    <div class="username">Bio :</div>
                    <div class="username"><?php echo $row["Bio"];?></div>
                </div>

            <?php
                }
            ?>

        <form action="./Controller/profile_auth.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?>">
            <textarea id="status" name="status" rows="5" class="form-control" ></textarea>
            <button class="btn nunito" id="button_submit" onclick="return statusValidate()">Change Status</button>
        </form>
            
        </div>
    </div>

</body>
</html>