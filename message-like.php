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

            $id=$_GET['id'];

            $query = "SELECT likes FROM message_board WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i",$id);
            $stmt->execute();  
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $likes = $row['likes'];

            $likes +=1; 
        
            $query = "UPDATE message_board SET likes=? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii",$likes,$id);
            $stmt->execute();  
            
            header("Location: message_board.php")
            ?>
    </body> 
</html>