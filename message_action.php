<?php 
    include "./connect.php"; 
    session_start();
?>
<!DOCTYPE html> 
<html>  
    <head> 
        <title>Details Accepted</title> 
    </head> 
    <body> 

    <?php
    
        $conn = connect();
        $query = "INSERT INTO message_board (message, user_id) VALUES (?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si",htmlspecialchars($_POST['message']),$_SESSION['user']);
        $stmt->execute();
        header("Location: message_board.php")
    ?>
    </body> 
</html>