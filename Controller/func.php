<?php

    function sesschk(){
        
        require "./Controller/conn.php";

        $query = "SELECT sess FROM info WHERE id = ?;";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $_SESSION['user_id'] );
        $stmt ->execute();
        $stmt->bind_result($dbsess);
        $stmt->fetch();
        $conn->close();

        if($_SESSION['sess'] != $dbsess ){
            $_SESSION['login'] = false;
            
        }

        if ($_SESSION['login'] != TRUE ) {
            
            session_unset();
            session_destroy();
            header("Location: ./login.php");
            exit();
        }

    }

    function csrfgen(){
        unset($_SESSION['csrf_token']);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

?>