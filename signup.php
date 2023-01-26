<?php 
    include "./connect.php"; 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="https://bootswatch.com/_vendor/jquery/dist/jquery.min.js"></script>
    <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">FaceBuk</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="./login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="./signup.php">Sign Up
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
<div class="mx-auto" style="width: 600px;">
    <form action="signup-action.php" method="post">
      <fieldset>
        <div class="form-group">
            <label for="name" class="form-label mt-4">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
        </div>
        <div class="form-group">
            <label for="username" class="form-label mt-4">Userame</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" maxlength="16" required>
            <?php if (!isset($_SESSION['username_error'])):?>
            <small class="form-text text-muted">max 16 characters</small>
            <?php else:?>
            <small id="emailHelp" class="form-text text-muted">This username has been taken.</small>
            <?php endif;?>
        </div>
        <div class="form-group">
            <label for="email_input" class="form-label mt-4">Email address</label>
            <input type="email" class="form-control" name="email" id="email_input" aria-describedby="emailHelp" placeholder="Enter email" required>
            <?php if (!isset($_SESSION['email_error'])):?>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            <?php else:?>
            <small id="emailHelp" class="form-text text-muted">This email has already got an account.</small>
            <?php endif;?>
        </div>
        <div class="form-group">
            <label for="password_input" class="form-label mt-4">Password</label>
            <input type="password" class="form-control" name="passw" id="password_input" placeholder="Password" required>
        </div>
        <button type="submit" class="mt-4 btn btn-primary">Sign Up</button>
      <fieldset>
    </form>
</div>

</body>
</html>

    