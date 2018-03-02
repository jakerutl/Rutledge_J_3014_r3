<?php
require_once('phpscripts/config.php');
// confirm_logged_in();
$id = $_SESSION['user_id'];
$tbl = "tbl_user";
$col = "user_id";
$popForm = getSingle($tbl, $col, $id);
$info = mysqli_fetch_array($popForm);
// echo $info;

  if(isset($_POST['submit'])){
    $fname = trim($_POST['fname']);
    $username = trim($_POST['username']);//add other coloumns to match below and also match the order in localhost
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
      $result = editUser($fname, $username, $password, $email, $id); //this must line up with database, thats why we didn't use the homework one
      $message = $result;
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit User</title>
</head>
<body>
<h2>Edit User</h2>
<?php  if(!empty($message)){echo $message;} ?>
<form action="admin_edituser.php" method="post">
  <label>First Name:</label>
  <input type="text" name="fname" value="<?php echo $info['user_fname']; ?>"><br><br>
  <label>Username:</label>
  <input type="text" name="username" value="<?php echo $info['user_name']; ?>"><br><br>
  <label>Password:</label>
  <input type="text" name="password" value="<?php echo $info['user_pass']; ?>"><br><br>
  <label>Email:</label>
  <input type="text" name="email" value="<?php echo $info['user_email']; ?>"><br><br>
  <input type="submit" name="submit" value="Save User">
</form>
</body>
</html>
