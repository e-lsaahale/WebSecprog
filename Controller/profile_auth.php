<?php
    session_start();
    require "./conn.php";

    function validateStatus($statusContent, $maxlength = 30){
        if( strlen($statusContent) > $maxlength){
            return false;
        }else{
            return true;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST"){

        if (!isset($_POST['csrf_token'])){
            die("csrf token not found!");
        }
        else if($_POST['csrf_token'] != $_SESSION['csrf_token']){
            die("failed to recognized credential");
        } 
        else{
            unset($_POST['csrf_token']);
        }

        if(isset($_POST['status'])){
            $statusContent = $_POST['status'];

            $finalizeValStatus = validateStatus($statusContent);

            $finalizeSanStatus= htmlspecialchars($statusContent, ENT_QUOTES, 'UTF-8');

            if($finalizeValStatus === TRUE ){
                $query = "UPDATE users SET Bio=? WHERE id=?;";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("si", $finalizeSanStatus, $_SESSION['user_id']);

                if ($stmt->execute()) {
                    header("Location: ../profile.php");
                } else {
                    echo "Your status changes is not saved. Please try again. :(";
                    header("Location: ../profile.php");
                }
                $stmt->close();
                echo "Your status has succesfully updated";
            }else{
                die("Failed to validate");
                
            }
        }
    }
?>