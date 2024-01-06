<?php
    session_start();
    require "./conn.php";

    function validateStory($storyContent, $maxlength = 150, $minlength = 5){
        if(empty($storyContent) || $storyContent == "" || strlen($storyContent) > $maxlength || strlen($storyContent) < $minlength){
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

        if(isset($_POST['message'])){
            $storyContent = $_POST['message'];

            $finalizeValStory = validateStory($storyContent);

            $finalizeSanStory= htmlspecialchars($storyContent, ENT_QUOTES, 'UTF-8'); 

            if($finalizeValStory === TRUE ){
                $query = "INSERT INTO post (message, user_id) VALUES (?,?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("si", $finalizeSanStory, $_SESSION['user_id']);

                if ($stmt->execute()) {
                    header("Location: ../send.php");
                    exit();
                } else {
                    echo "Story has not been sent. Please try again. :(";
                    header("Location: ../send.php");
                    exit();
                }
                $stmt->close();
                echo "success";
            }else{
                echo "<script>window.location.href='../send.php?error=1';</script>";
                exit();
            }
        }
    }


?>