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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Binus CurCol</title>

    <link rel="stylesheet" href="./Assets/mainstyle.css">
    <script>
        function logOut() { 
            var targetURL = 'login.php';
            window.location.href = targetURL;
        }

        function profile() { 
            var targetURL = 'profile.php';
            window.location.href = targetURL;
        }

        function send() { 
            var targetURL = 'send.php';
            window.location.href = targetURL;
        }
    </script>

    <style>
        .username {
            display: flex;
            flex-direction: row;
            font-size: 15px;
            font-weight: bold;
            margin-left: 10px;
            margin-bottom: 10px;
        }

        .message{
            display: flex;
            flex-direction: row;
            font-size: 12px;
            margin-left: 10px;
            margin-bottom: 10px;
        }

    </style>

</head>

<body>

    <div class="top-bar" >

        <a class="bcc-txt">Binus Curcol</a>
        <div class="buttons">
            <button class="exit-btn" onclick="send()"> Create Post </button>
            <button class="exit-btn" onclick="profile()"> Profile </button>
            <form action="./Controller/exit.php" method="POST">
                <button class="exit-btn" > Log Out </button>
            </form>
            
        </div>
    </div>

    <div class="container">
        <div class="box">
            <?php
                require "./Controller/conn.php";
                $stmt = $conn->prepare("SELECT * FROM post JOIN users ON post.user_id = users.id
                WHERE post.user_id IS NOT NULL;");
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()){
            ?>
                <div class="username"><?php echo $row["Username"];?></div>
                <div class="message"><?php echo $row["message"];?></div>
            <?php
                }
                ?>
        </div>
    </div>


    <script src="./Assets/mainscript.js"></script>
</body>
</html>