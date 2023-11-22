<?php
    
    // if($_SESSION['login'] === true){
        session_destroy();
    // }
    header("Location: ../login.php");
?>