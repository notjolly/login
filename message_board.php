<?php 
    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: ./login.php");
    }
    require "nav.php";
    $conn = connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Board</title>

    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
    <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      const interval = setInterval(function() {
      const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
          document.getElementById("messages").innerHTML = 
          this.responseText;
        }
        xhttp.open("GET","messages.php");
        xhttp.send();
      },0500);
    </script>
    
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-4 pt-5 mx-auto" id="messages">
        <?php
        $query = "SELECT * FROM message_board ORDER BY id DESC";
  $results=mysqli_query($conn,$query);
  $row_count=mysqli_num_rows($results);


  while ($row = mysqli_fetch_array($results)) :?>
    <?php 
      $query = "SELECT username, profilePic FROM users WHERE id =". $row['user_id'];
      $uresults=mysqli_query($conn,$query);
      $userrow = mysqli_fetch_array($uresults);
    ?>
    <?php if ($_SESSION["user"] == $row["user_id"]):?>
      <center>
      <div class= "toast show" role="alert" aria-live="assertive" aria-atomic="true" style="background-color:#B6D0E2; margin-left:10%;width: 400px;border-color:black">
        <div class="toast-header" style="background-color:#B6D0E2">
          <img src="uploads/<?php echo $userrow["profilePic"]?>" class="img-fluid rounded mx-1 my-1" alt="" style="width:40px;height:40px">
          <strong class="me-auto">  <?php echo $userrow["username"]?></strong>
          <small><?php echo $row["time"]?></small>
          <?php
            if ($user->level=="Admin"):?>
            <a href="message-delete-action.php?id=<?php echo $row['id']?>" class="btn-close"></a>
          <?php endif;?>
        </div>
        <div class="toast-body" style="background-color:#B6D0E2">
          <?php echo $row["message"] ?>
        </div>
        <div class="toast-footer">
          <a href="message-like.php?id=<?php echo $row['id']?>">
          <img src="emojis/like.png" class="img-fluid rounded-top" style="width:40px;height:40px">
          </a>
          <p><?php echo $row['likes']; ?></p>
        </div>
    </div>
    </center>

    <?php else:?>
    <center>
      <div class= "toast show" role="alert" aria-live="assertive" aria-atomic="true" style="margin-right:10%;width: 400px;border-color:black">
        <div class="toast-header">
        <img src="uploads/<?php echo $userrow["profilePic"]?>" class="img-fluid rounded mx-1 my-1" alt="" style="width:40px;height:40px">
          <strong class="me-auto">  <?php echo $userrow["username"]?></strong>
          <small><?php echo $row["time"]?></small>
          <?php
            if ($user->level=="Admin"):?>
            <a href="message-delete-action.php?id=<?php echo $row['id']?>" class="btn-close"></a>
          <?php endif;?>
        </div>
        <div class="toast-body">
          <?php echo $row["message"] ?>
        </div>
        <div class="toast-footer">
          <a href="message-like.php?id=<?php echo $row['id']?>">
          <img src="emojis/like.png" class="img-fluid rounded-top" style="width:40px;height:40px">
          </a>
          <p><?php echo $row['likes']; ?></p>
        </div>
      </div>
    </center>
    <?php endif;?>
    
  <?php endwhile;?>
  
      </div>
    </div>
</div>
<div class="fixed-bottom d-flex justify-content-center" style="position: fixed;">
    <form action="message_action.php" method="post">
        <input type="text" class= "my-2" name="message"required> 
        <button type="submit" class="mx-2 my-2 btn btn-primary">Send</button>
    </form>
</div>

</body>
</html>