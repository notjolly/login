<?php 
    require "./user.php";
    session_start();
?>
<!DOCTYPE html> 
<html>  
    <head> 
        <title>Details Accepted</title> 
    </head> 
    <body> 

        <?php 
            $email = htmlspecialchars($_POST['email']);
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['passw']);
            $name = htmlspecialchars($_POST['name']);
            $level = "User";
            $profilePic = "default.png";
            $id = NULL;
            $signup = new User($id,$email,$password,$name,$username,$level,$profilePic);
            $signup->add();

        ?>
    </body> 
</html>