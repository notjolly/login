<?php 
    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: ./login.php");
    }
    require "nav.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>

    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
    <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>



<div class="mx-auto pt-5" style="width:600px">

<!-- Button trigger modal -->
<center>
<button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
  <img src="uploads/<?= $user->profilePic; ?>" class="img-fluid rounded" alt="" style="width:100px;height:100px">
</button>
</center>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <center>
        <img src="uploads/<?= $user->profilePic; ?>" class="img-fluid rounded" alt="" style="width:400px;height:400px">
        </center>
        <form action="upload.php" method="post" enctype="multipart/form-data">
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Upload Image" name="submit">
        </form>
      </div>
    </div>
  </div>
</div>


<form action="./settings-action.php" method="post">
  <fieldset>
    <div class="form-group">
      <fieldset>
        <label class="form-label mt-4" for="email">Email</label>
        <input class="form-control" id="email" name="email" type="text" value="<?= $user->email; ?>">
      </fieldset>
    </div>
    <div class="form-group">
      <fieldset>
        <label class="form-label mt-4" for="username">Username</label>
        <input class="form-control" id="username" name="username" type="text" maxlength="15" value="<?= $user->username; ?>">
    </fieldset>
    </div>
    <div class="form-group">
        <label for="currentpassword" class="form-label mt-4">Password</label>
        <input type="password" class="form-control" id="currentpassword" name="currentpassword">
    </div>
    <div class="form-group">
        <label for="newpassword" class="form-label mt-4">New Password</label>
        <input type="password" class="form-control" id="newpassword" name="newpassword">
    </div>
    <div class="form-group">
        <label for="verifypassword" class="form-label mt-4">Verify Password</label>
        <input type="password" class="form-control" id="verifypassword" name="verifypassword">
    </div>
    <button type="submit" class="btn btn-primary mt-4">Submit</button>
  </fieldset>
</form>
</div>
</body>
</html>