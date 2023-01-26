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
        xhttp.open("GET","direct-messages.php?to=<?php echo $_GET['to']?>");
        xhttp.send();
      },0500);
    </script>
    
</head>
<body>

<div class="container pt-5">
    <div class="row">
        <h2>Direct Message</h2>
        <div class="col-3 pt-3">
        <table>
        <?php
            $query = "SELECT * FROM users";
            $results=mysqli_query($conn,$query);

            while ($row = mysqli_fetch_array($results)) :?>
            <tr>
                <td><a class="nav-link " href="./direct-message.php?to=<?php echo $row['id']?>">
                <?php 
                if ($row["id"] != $_SESSION["user"]){
                     
                if (isset($_GET['to'])){ 
                    if ($_GET['to']==$row['id']){ 
                        echo '<h5 style="color:#18bc9c">'.$row["username"].'<?h5>';
                    }
                    else{
                        echo '<h5>'.$row["username"].'<?h5>';
                    }
                }
                else{
                    echo '<h5>'.$row["username"].'<?h5>';
                }
                }
                ?>
                </a></td>
            </tr>
            <?php endwhile;?>
            </table>
        </div>
        <div class="col-9">
            <div id="messages">
            <?php
            $query = "SELECT * FROM direct_message ORDER BY id DESC";
            $results=mysqli_query($conn,$query);
            $row_count=mysqli_num_rows($results);

            if (isset($_GET["to"])){
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
            <?php endwhile;
            }?>
            </div>
            <div class="fixed-bottom d-flex justify-content-center" style="position: fixed;">
                <?php if (isset($_GET["to"])):?>
                <form action="direct-action.php?to=<?php echo $_GET['to']?>" method="post">
                    <input type="text" class= "my-2" name="message"required> 
                    <button type="submit" class="mx-2 my-2 btn btn-primary">Send</button>
                </form>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

</body>
</html>