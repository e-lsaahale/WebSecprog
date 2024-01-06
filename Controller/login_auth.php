<?php

    session_start();

    function unlockacc(){
            require "./conn.php";
            $att = 0;
            $stat = true;
            $query = "UPDATE info SET attempt = ?, stat = ? WHERE id = ?;";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("isi", $att, $stat ,$_SESSION['user_id']);
            $stmt ->execute();
    }

    require "./conn.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $username = trim($_POST['username']);
        $pass = ($_POST['password']);

        $query = "SELECT * FROM users WHERE Username=?;";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt ->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if($result->num_rows == 1){

            $_SESSION['user_id'] = $row['Id'];

            $query = "SELECT * FROM info WHERE id = ?;";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $_SESSION['user_id'] );
                $stmt ->execute();
                $result = $stmt->get_result();
                $status = $result->fetch_assoc();

            if($status != NULL && $status['stat'] != TRUE){
                
                $cd = time() - strtotime($status['times']);

                if($cd < 300 ){
                    die("Account Locked!\nwait for " . 300-$cd . "s" );
                }
                else{
                    unlockacc();
                }
                
            }

            $query = "SELECT Passwd FROM users WHERE Id=?;";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $_SESSION['user_id']);
            $stmt ->execute();

            $stmt->bind_result($dbpassword);
            $stmt->fetch();
            $stmt->close();

            if(password_verify($pass, $dbpassword)){

                $sess = bin2hex(random_bytes(32));
                
                $_SESSION['username'] = $row['Username'];
                $_SESSION['pass'] = $row['Passwd'];
                $_SESSION['sess'] = $sess;

                $query = "SELECT * FROM info WHERE id = ?;";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $_SESSION['user_id'] );
                $stmt ->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if ($row === NULL){

                    $query = "INSERT INTO info (id, sess) VALUES(?,?);";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("is", $_SESSION['user_id'], $sess);
                    $stmt ->execute();

                }
                else{

                    if($row['sess'] != $sess){
    
                        $query = "UPDATE info SET sess = ? WHERE id = ?;";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("si",$sess, $_SESSION['user_id']);
                        $stmt ->execute();
                    }
                }

                unlockacc();

                $_SESSION['login'] = true;
                $conn->close();
                header("Location: ../send.php");
                exit();
            }
            else{

                $query = "SELECT * FROM info WHERE id = ?;";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $_SESSION['user_id'] );
                $stmt ->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($row != NULL){
                    
                    $attempt = $row['attempt'];
                    $attempt++;

                    $query = "UPDATE info SET attempt = ? WHERE id = ?;";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ii", $attempt ,$_SESSION['user_id']);
                    $stmt ->execute();
                }else{

                    $attempt = 1;
                    $stat = TRUE;
                    $query = "INSERT INTO info (id, attempt, stat) VALUES(?,?,?);";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("iis", $_SESSION['user_id'], $attempt, $stat);
                    $stmt ->execute();
                }

                if($attempt == 5){
                    $currenttime = date("Y-m-d H:i:s");
                    $stat = FALSE;

                    $query = "UPDATE info SET stat = ?, times = ? WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ssi", $stat, $currenttime ,$_SESSION['user_id']);
                    $stmt ->execute();

                }

                $conn->close();
                header("Location: ../login.php");
                exit();

            }
            
        }
        else{
            $conn->close();
            die("Credential not found!");
        }

    }
?>