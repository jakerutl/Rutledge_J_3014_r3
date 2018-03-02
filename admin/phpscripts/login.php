<?php
	// require_once('phpscripts/config.php');
	function logIn($username, $password, $ip) {
		require_once('connect.php');
		$username = mysqli_real_escape_string($link, $username);
		$password = mysqli_real_escape_string($link, $password);
		$loginstring = "SELECT * FROM tbl_user WHERE user_name='{$username}'";
		$user_set = mysqli_query($link, $loginstring);

		// echo mysqli_num_rows($user_set);


		if(mysqli_num_rows($user_set)){
			$founduser = mysqli_fetch_array($user_set, MYSQLI_ASSOC);

			$id = $founduser['user_id'];
			if(password_verify($password, $founduser["user_pass"]) &($founduser['user_fail'] < 3)){
				$_SESSION['user_id'] = $id;
				$_SESSION['user_name']= $founduser['user_fname'];
				$_SESSION['user_last']= $founduser['user_last'];
				date_default_timezone_set('America/Toronto');
				$date = date('Y-m-d H:i:s');

				if(mysqli_query($link, $loginstring)){
					$update = "UPDATE tbl_user SET user_ip='{$ip}' WHERE user_id={$id}";
					$updatequery = mysqli_query($link, $update);
					$query1 = "UPDATE `tbl_user` SET `user_last`='{$date}' WHERE user_id={$id}";
					$query_run1 = mysqli_query($link, $query1);
					$failquery = "UPDATE `tbl_user` SET `user_fail`= 0 WHERE `user_id`={$id}";
					$fail_run = mysqli_query($link, $failquery);
					$newquery = "UPDATE `tbl_user` SET `user_new`= 1 WHERE `user_id`={$id}";
					$new_run = mysqli_query($link, $newquery);
					// $newnum = $founduser['user_new'] + 1;
					// $newquery = "UPDATE `tbl_user` SET `user_new` = {$newnum} WHERE `user_id` = {$id}";
					// $new_run = mysqli_query($link, $newquery);

					if($founduser['user_new'] > 0){ // if the user has a user_new of less then 0 then they will be redirected to edit_user page
						$newnum = $founduser['user_new'] + 1;
						$newquery = "UPDATE `tbl_user` SET `user_new` = {$newnum} WHERE `user_id` = {$id}";
						$new_run = mysqli_query($link, $newquery);
					}else{
						redirect_to("admin_edituser.php");
					}
				}
				redirect_to("admin_index.php"); //once a user has logged in more than once they'll be redirected to admin_index page

			}else if($founduser['user_fail'] < 3){
				$num = $founduser['user_fail'] + 1;
				$failquery = "UPDATE `tbl_user` SET `user_fail` = {$num} WHERE `user_id` = {$id}";
				$fail_run = mysqli_query($link, $failquery);
				return "Wrong password...";
			}else{
				//lock out
				return "Locked Out! Now you have no way back in!!!! ";
			}
		}else{
			$message = "You spelled the user name wrong...";
			return $message;
		}

		mysqli_close($link);
	}
?>
