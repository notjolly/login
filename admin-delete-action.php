<?php 
    include "./user.php"; 
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
            $passw = $_POST['passw'];
            $user = User::load_by_id($_SESSION["user"]);
            if (password_verify($passw, $user->password)){
                $query = "DELETE FROM message_board";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                header("Location: message_board.php");
            }
        ?>
    </body> 
</html>