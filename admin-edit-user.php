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
    <title>Edit User</title>

    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
    <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>
<div class="mx-auto pt-5" style="width:600px">
<form action="./admin-edit-action.php" method="post">
  <fieldset>
    <div class="form-group">
      <fieldset>
        <label class="form-label mt-4" for="id">ID</label>
        <input class="form-control" id="id" name="id" type="text" value="<?php echo $row["id"];?>" readonly="">
      </fieldset>
    </div>
    <div class="form-group">
      <fieldset>
        <label class="form-label mt-4" for="email">Email</label>
        <input class="form-control" id="email" name="email" type="text" value="<?php echo $row["email"];?>" readonly="">
      </fieldset>
    </div>
    <div class="form-group">
      <fieldset>
        <label class="form-label mt-4" for="username">Username</label>
        <input class="form-control" id="username" name="username" type="text"  maxlength="16" value="<?php echo $row["username"];?>">
      </fieldset>
    </div>
    <div class="form-group">
      <label for="exampleSelect1" class="form-label mt-4"></label>
      <select class="form-select" id="exampleSelect1" name="level">
        <option>User</option>
        <option>Admin</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary mt-4">Submit</button>
  </fieldset>
</form>
</div>
</body>
</html>