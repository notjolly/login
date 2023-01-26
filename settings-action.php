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

            $id = $_SESSION["user"];
            $user = User::load_by_id($id);
            
            unset($_SESSION['email_error']);
            unset($_SESSION['username_error']);
           
            $email = htmlspecialchars($_POST['email']);
            $username = htmlspecialchars($_POST['username']);

            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s",$email);
            $stmt->execute();  
            $result = $stmt->get_result();
            $emails = mysqli_num_rows($result);
            if (!$emails == 0){
            $row = $result->fetch_assoc();
                if ($id != $row["id"]){
                    $_SESSION['email_error']=true;  
                    header("Location: settings.php");
                    return;
                }
            }
            
            $query = "SELECT * FROM users WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s",$username);
            $stmt->execute();  
            $result = $stmt->get_result();
            $usernames = mysqli_num_rows($result);
            if (!$usernames == 0){
            $row = $result->fetch_assoc();
                if ($id != $row["id"]){
                    $_SESSION['username_error']=true;
                    header("Location: settings.php");
                    return;
                }
            }

            $currentpassword = $_POST["currentpassword"];
            $newpassword = $_POST["newpassword"];
            $verifypassword = $_POST["verifypassword"];
            if (password_verify($currentpassword, $user->password)){
                if ($newpassword == ""){
                    
                    $query = "UPDATE users SET username=?, email=? WHERE id =?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ssi",$username,$email,$id);
                    $stmt->execute();
                    header("Location: settings.php");
                }
                else if ($newpassword == $verifypassword){
                    $hash = password_hash($newpassword,PASSWORD_DEFAULT);
                    $query = "UPDATE users SET username=?,password=?, email=? WHERE id =?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("sssi",$username,$hash,$email,$id);
                    $stmt->execute();
                    header("Location: settings.php");
                }
            } 
            else{
                $_SESSION['cpass_error']=true;
                header("Location: settings.php");
            }           
        ?>
    </body> 
</html>