<?php 
    session_start();
    session_destroy();
    include "./connect.php"; 
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
          <a class="nav-link active" href="./login.php">Login <span class="visually-hidden">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./signup.php">Sign Up
          </a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
<div class="mx-auto" style="width: 600px;">
    <form action="login-action.php" method="post">
      <fieldset>
        <div class="form-group">
            <label for="email_input" class="form-label mt-4">Email address</label>
            <input type="email" class="form-control" name="email" id="email_input" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="password_input" class="form-label mt-4">Password</label>
            <input type="password" class="form-control" name="passw" id="password_input" placeholder="Password" required>
        </div>
        <button type="submit" class="mt-4 btn btn-primary">Login</button>
      <fieldset>
    </form>
</div>

</body>
</html>