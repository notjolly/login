<?php 
  session_start();
  if (!isset($_SESSION["user"])){
    header("Location: ./login.php");
  }
  include "./user.php"; 
  $conn = connect();
  $user = User::load_by_id($_SESSION['user']);

  $query = "SELECT * FROM direct_message ORDER BY id DESC";
  $results=mysqli_query($conn,$query);
  $row_count=mysqli_num_rows($results);
  
  $to = $_GET["to"];

  while ($row = mysqli_fetch_array($results)) :?>
    <?php 
      $query = "SELECT username, profilePic FROM users WHERE id =". $row['sent_from'];
      $uresults=mysqli_query($conn,$query);
      $userrow = mysqli_fetch_array($uresults);
      if ($user->id == $row["sent_from"] and $to == $row["sent_to"])
    
        if ($user->id == $row["sent_from"]):?>

        <center>
        <div class= "toast show" role="alert" aria-live="assertive" aria-atomic="true" style="margin-left:10%;width: 400px;border-color:black">
            <div class="toast-header" style="background-color:#B6D0E2">
            <img src="uploads/<?php echo $userrow["profilePic"]?>" class="img-fluid rounded mx-1 my-1" alt="" style="width:40px;height:40px">
            <strong class="me-auto">  <?php echo $userrow["username"]?></strong>
            <small><?php echo $row["time"]?></small>
            <?php
                if ($user->level=="Admin"):?>
                <a href="direct-delete-action.php?id=<?php echo $row['id']?>&to=<?php echo $_GET['to']?>" class="btn-close"></a>
            <?php endif;?>
            </div>
            <div class="toast-body" style="background-color:#B6D0E2">
            <?php echo $row["message"] ?>
            </div>
        </div>
        </center>
        <?php endif;?>

    <?php if ($to == $row["sent_from"] and $user->id == $row["sent_to"]):?>

        <center>
        <div class= "toast show" role="alert" aria-live="assertive" aria-atomic="true" style="margin-right:10%;width: 400px;border-color:black">
            <div class="toast-header">
            <img src="uploads/<?php echo $userrow["profilePic"]?>" class="img-fluid rounded mx-1 my-1" alt="" style="width:40px;height:40px">
            <strong class="me-auto">  <?php echo $userrow["username"]?></strong>
            <small><?php echo $row["time"]?></small>
            <?php
                if ($user->level=="Admin"):?>
                <a href="direct-delete-action.php?id=<?php echo $row['id']?>&to=<?php echo $_GET['to']?>" class="btn-close"></a>
            <?php endif;?>
            </div>
            <div class="toast-body">
            <?php echo $row["message"] ?>
            </div>
        </div>
        </center>

    <?php endif;?>
  <?php endwhile;?>