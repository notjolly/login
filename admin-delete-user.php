<?php 
    include "./user.php"; 
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
            $id = $_GET["id"];
            $user = User::load_by_id($id);
            $user->delete();
            
            header("Location: admin-user.php");
            
        ?>
    </body> 
</html>