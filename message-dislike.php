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
            $user = User::load_by_id($_SESSION["user"]);
            $conn = connect();

            $message_id=$_GET['id'];

            $query = "SELECT * FROM dislikes WHERE message_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i",$message_id);
            $stmt->execute();  
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()){
                if ($row['user_id'] == $user->id){
                    $query = "DELETE FROM dislikes WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i",$row["id"]);
                    $stmt->execute();
                    $liked=true;
                }
            }
            if (!$liked == true){
                $query = "INSERT into dislikes (user_id, message_id) VALUES (?,?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ii",$user->id,$message_id);
                $stmt->execute();  
            }

            $query = "SELECT * FROM dislikes WHERE message_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i",$message_id);
            $stmt->execute();
            $result3 = $stmt->get_result();
            $num = mysqli_num_rows($result3);

            $query = "UPDATE message_board SET dislikes = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii",$num, $message_id);
            $stmt->execute(); 
            
            header("Location: message_board.php")
            ?>
    </body> 
</html>