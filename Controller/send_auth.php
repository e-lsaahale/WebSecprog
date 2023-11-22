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
        if(isset($_POST['message'])){
            $storyContent = $_POST['message'];

            $finalizeValStory = validateStory($storyContent);

            $finalizeSanStory= htmlspecialchars($storyContent, ENT_QUOTES, 'UTF-8');

            if($finalizeValStory === TRUE ){
                $stmt = $conn->prepare("INSERT INTO post (Message) Values (?, ?, ?, ?)");
                $stmt->bind_param("s", $finalizeSanStory);

                if ($stmt->execute()) {
                    echo "Story has been sent! :D";
                } else {
                    echo "Story has not been sent. Please try again. :(";
                    header("Location: ../send.html");
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