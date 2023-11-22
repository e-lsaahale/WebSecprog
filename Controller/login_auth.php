<?php

    session_start();

    require "./conn.php";

    $login = false;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $username = trim($_POST['username']);
        $length = strlen($username);
        if($length < 6){ 
            header("Location: ../login.php");
        } else if($length > 16) {
            header("Location: ../login.php");
        }


        $pass = trim($_POST['password']);

        $query = "SELECT * FROM users WHERE Username=? AND Passwd=?;";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $pass);
        $stmt ->execute();
        $result = $stmt->get_result();
        $conn->close();

    
        if($result->num_rows == 1){
            echo "Login Success";
            $row = $result->fetch_assoc();

            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['Username'];
            $_SESSION['pass'] = $row['Passwd'];

            header("Location: ../send.php");
        }
        else{
            
            echo "<script>window.location.href='../login.php?error=1';</script>";
            exit();
        }
    }
?>