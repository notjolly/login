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
    
</head>
<body>

<div class="mx-auto pt-5" style="width:600px">
  <table class="table table-hover">
    <tr class="table-primary">
      <th scope="col">Username</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">User Level</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  <?php
    

    $query = "SELECT * FROM users";
    $results=mysqli_query($conn,$query);

    while ($row = mysqli_fetch_array($results)) :?>
      <tr>
        <td><?php echo $row["username"];?></td>
        <td><?php echo $row["name"];?></td>
        <td><?php echo $row["email"];?></td>
        <td><?php echo $row["level"];?></td>
        <td><a href="./admin-edit-user.php?id=<?php echo $row["id"]?>" class="btn btn-success">Edit</a></td>
        <td><a href="./admin-delete-user.php?id=<?php echo $row["id"]?>" class="btn btn-danger">Delete</a></td>
      </tr>
    <?php endwhile;?>
  </table>
</div>
</body>
</html>