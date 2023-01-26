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
            $email = $_POST['email'];
            $passw = $_POST['passw'];
            $user = User::login($email, $passw);
            if ($user == false){
                header("Location: ./login.php");
            }
            else{
                $_SESSION["user"]= $user->id;
                header("Location: ./message_board.php");
            }
            
            var_dump($_SESSION["user"]);
        ?>
    </body> 
</html>