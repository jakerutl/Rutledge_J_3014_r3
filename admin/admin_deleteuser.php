<?php
require_once('phpscripts/config.php');
// confirm_logged_in();
$tbl = "tbl_user";
$users = getAll($tbl);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Delete User</title>
</head>
<body>
  <h2>Time to destroy some lives...</h2>
  <?php
  while($row = mysqli_fetch_array($users)){
    echo "{$row['user_fname']} <a href=\"phpscripts/caller.php?caller_id=delete&id={$row['user_id']}\">fired</a><br>";
  }

   ?>
</body>
</html>
