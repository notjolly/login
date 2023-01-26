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
    <form action="admin-delete-action.php" method="post">
      <fieldset>
        <div class="form-group">
            <label for="password_input" class="form-label mt-4">Enter Password</label>
            <input type="password" class="form-control" name="passw" id="password_input" placeholder="Password" required>
        </div>
        <button type="submit" class="mt-4 btn btn-primary">Delete All Messages</button>
      <fieldset>
    </form>
</div>
</form>
</div>
</body>
</html>