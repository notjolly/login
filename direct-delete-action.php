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
            $query = "DELETE FROM direct_message WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $_GET['id']);
            $stmt->execute();
            $location = "Location: direct-message.php?to=".$_GET['to'];
            header($location)
            ?>
    </body> 
</html>