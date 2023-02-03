<?php 
require "./user.php";
$user = User::load_by_id($_SESSION["user"]);

if (str_ends_with($_SERVER["PHP_SELF"],"settings.php")){
    $active_settings = "active";
}
if (str_ends_with($_SERVER["PHP_SELF"],"message_board.php")){
    $active_message_board = "active";
}
if (str_ends_with($_SERVER["PHP_SELF"],"direct-message.php")){
  $active_direct_message = "active";
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-static-top" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#">FaceBuk</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link <?php echo $active_message_board?>" href="./message_board.php">Public <span class="visually-hidden">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $active_direct_message?>" href="./direct-message.php">Direct <span class="visually-hidden">(current)</span></a>
        </li>
      </ul>
      <div class="d-flex">
        <ul class="navbar-nav me-auto">
          <?php
            if ($user->level=="Admin"):?>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Admin</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="admin-delete-message.php">Mass Delete Messages</a>
                <a class="dropdown-item" href="admin-user.php">Edit User</a>
            </div>
            </li>
            <?php endif;?>
          <li class="nav-item">
            <a class="nav-link" href="./logout-action.php">Logout</a>
          </li>
          <li>
            <a class="nav-link <?php echo $active_settings?>" href="./settings.php">Settings</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>