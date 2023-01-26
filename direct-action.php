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
        $to = $_GET["to"];
        $conn = connect();
        $query = "INSERT INTO direct_message (message, sent_from, sent_to) VALUES (?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sii",htmlspecialchars($_POST['message']),$_SESSION['user'],$to);
        $stmt->execute();
        $location="Location: direct-message.php?to=". $_GET['to'];
        header($location);
    ?>
    </body> 
</html>