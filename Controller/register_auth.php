<?php

session_start();
require "./conn.php";
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $fullname = trim(htmlspecialchars($_POST['name']));
    $length = strlen($fullname);
    if($length < 5 || $length > 25){ 
        die ("Name must be between 5 and 25 characters!");

    }

    $username = trim(htmlspecialchars($_POST['username']));
    $length = strlen($username);
    if($length < 6 || $length > 25){ 
        die ("Username must be between 6 and 25 characters!");

    }

    $email = trim($_POST['email']);
    $email_sanitized = filter_var($email, FILTER_SANITIZE_EMAIL);
    if(!filter_var($email_sanitized, FILTER_VALIDATE_EMAIL)){
        die ("Wrong email format!");

    }
    
    $age = trim($_POST['age']);
    if($age < 17 || $age > 99){
        die ("Age must be between 17 and 99!");

    }

    $password = $_POST['password'];
    $length = strlen($password);
    if($length < 8 || $length > 16){ 
        die ("Password length must be between 8 and 16 characters");

    }
    else if (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)){
        die ("password must be contain at least one capital character and one number!");

    }

    $query = "SELECT * FROM users where Username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result_usn = $stmt->get_result();

    $query = "SELECT * FROM users where Email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result_email = $stmt->get_result();

    if($result_usn->num_rows > 0){
        die ("Username already used");
    }
    else if($result_email->num_rows > 0){
        die ("Email already used");
    }
    else{
        
        $passwd = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (name, username, email, age, passwd) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssis", $fullname, $username, $email, $age, $passwd);
        if($stmt ->execute()){
            echo "Registration complete!";
        }
        else{
            echo "Error " . $stmt->error;
        }

    }

    $conn->close();
    session_unset();
    session_destroy();
}
?>