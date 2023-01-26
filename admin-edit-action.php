<?php 
    include "./connect.php"; 
    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: ./login.php");
    }
    $conn = connect();
    $sql = "SELECT level FROM users WHERE id = ".$_SESSION['user'];
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $_SESSION["level"] = $row["level"]; 
    if ($_SESSION["level"]=="User"){
      header("Location: ./message_board.php");
    }
?>
<!DOCTYPE html> 
<html>  
    <head> 
        <title>Details Accepted</title> 
    </head> 
    <body> 

        <?php 
            
            $level = htmlspecialchars($_POST['level']);
            $username = htmlspecialchars($_POST['username']);
            $id = htmlspecialchars($_POST["id"]);

            $sql = "SELECT * FROM users WHERE id = '$id'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);

            $sql2 = "SELECT * FROM users WHERE username = '$username'";
            $un_result = mysqli_query($conn,$sql);
            $usernames = mysqli_num_rows($un_result);
            $un_row = mysqli_fetch_assoc($un_result);
            
            if ($usernames==1){
                var_dump($id);
                var_dump($un_row["id"]);
                if (!$id == $un_row["id"]){
                    header("Location: admin-edit-user.php");
                }
                else {
                    $query = "UPDATE users SET username=?, level=? WHERE id =?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ssi",$username,$level,$id);
                    $stmt->execute();
                    header("Location: admin-user.php");
                }
            }
            else {
            $query = "UPDATE users SET username=?, level=? WHERE id =?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssi",$username,$level,$id);
            $stmt->execute();
            header("Location: admin-user.php");
            }
        ?>
    </body> 
</html>