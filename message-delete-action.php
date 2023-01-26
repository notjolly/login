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
            $query = "DELETE FROM message_board WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $_GET['id']);
            $stmt->execute();
            header("Location: message_board.php")
            ?>
    </body> 
</html>