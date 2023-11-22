<?php
session_start();
require "./conn.php";
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $fullname = trim($_POST['name']);
    $length = strlen($fullname);
    if($length < 5 || $length > 25){ 
        echo "<script>window.location.href='../register.php?error=1';</script>";
        exit();
        
    }

    $username = trim($_POST['username']);
    $length = strlen($username);
    if($length < 5 || $length > 25){ 
        echo "<script>window.location.href='../register.php?error=1';</script>";
        exit();
    }

    $email = trim($_POST['email']);
    $regex = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]+$/';
    $length = strlen($email);
    if(!preg_match($regex, $email)){
        echo "<script>window.location.href='../register.php?error=1';</script>";
        exit();
    }
    
    $age = trim($_POST['age']);
    if($age < 17 || $age > 99){
        echo "<script>window.location.href='../register.php?error=1';</script>";
        exit();
    }

    $password = $_POST['password'];
    $length = strlen($password);
    if($length < 8 || $length > 16){ 
        echo "<script>window.location.href='../register.php?error=1';</script>";
        exit();
    }

    $query = "INSERT INTO users VALUE (name =?, username =?, email =?, age =?, passwd =?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssis", $fullname, $username, $email, $age, $password);
    $stmt ->execute();
    $conn->close();
}
?>