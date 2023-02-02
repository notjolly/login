<?php 
    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: ./login.php");
    }
    include "nav.php"; 
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
    
    
    
</head>
<body>

<div class="container" id="messages">
    <div class="row">
        <div class="col-sm-4 py-5 mx-auto" >
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
                  <a href="message-like.php?id=<?php echo $row['id']?>" style="color:transparent">
                  <img src="emojis/like.png" style="width:40px;height:40px">
                  </a>
                  <p style="display:inline"><?php echo $row['likes']; ?></p>
                  <a href="message-dislike.php?id=<?php echo $row['id']?>" style="color:transparent">
                  <img src="emojis/dislike.png" style="width:40px;height:40px">
                  </a>
                  <p style="display:inline"><?php echo $row['dislikes']; ?></p>
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
                <a href="message-like.php?id=<?php echo $row['id']?>" style="color:transparent">
                <img src="emojis/like.png" style="width:40px;height:40px">
                </a>
                <p style="display:inline"><?php echo $row['likes']; ?></p>
                <a href="message-dislike.php?id=<?php echo $row['id']?>" style="color:transparent">
                <img src="emojis/dislike.png" style="width:40px;height:40px">
                </a>
                <p style="display:inline"><?php echo $row['dislikes']; ?></p>
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

<?php
$sql = "SELECT id,message FROM message_board ORDER BY id DESC LIMIT 1";
$sqlquery = $conn->query($sql);
$row = $sqlquery->fetch_assoc();
$idresult = $row['id'];
$messagecontent = $row['message'];
$countsql = "SELECT COUNT(*) FROM message_board";
$countsqlquery = $conn->query($countsql);
$count = $countsqlquery->fetch_assoc();
?>
<script>
      var lastMessageId = <?php echo $idresult ?>;
      var lastMessageContent = "<?php echo $messagecontent ?>";
      var rowCount = <?php echo $count['COUNT(*)'] ?>;
      setInterval(function () {    
        $.ajax({
          type: "POST",
          url: "check-update.php",
          dataType: "json",
          success: function (response){
            var data = response;
            console.log(data);
            if (rowCount+lastMessageId+lastMessageContent != data) { 
              $("#messages").load("message_board.php #messages");
            }        
          }
              
        });}, 
        1000);
    </script>

</body>
</html>