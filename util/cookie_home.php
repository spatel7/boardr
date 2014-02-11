<?php	
	if (isset($_COOKIE['lgn_user_id3'])) {
		$username = mysql_real_escape_string($_COOKIE['lgn_user_id3']);
		$k = mysql_real_escape_string($_COOKIE['lgn_pass_id3']);
		$online = false;

		//correct password?
		$check = mysql_query("SELECT * FROM users WHERE username='".$username."'") or die("Could not check: ".mysql_error());
		while ($info = mysql_fetch_array($check)) {
			$usern = $info['username'];
			$number = $info['uid'];
			$last_fetch = $info['last_fetch'];



			$a = mysql_query("Select * from live where uid=".$number." and ukey='".$k."'") or die("Could not check online: ".mysql_error());
			while ($b = mysql_fetch_array($a)) {
				$online = true;
			}	
			if ($online) {
				$pic = mysql_query("SELECT is_photo FROM users WHERE uid=".$number) or die("Could not check photo in coooki: ".mysql_error());
				if ($a=mysql_fetch_array($pic)) {
					if ($a['is_photo'] == 0) {
						$img = "images/icon.jpg";
					} elseif ($a['is_photo'] == 1) {
						$img = "user_photos/".$number.".jpg";
					}
				}

			} else { header("Location:index.php"); }
		}
		
	} else {
		header("Location:index.php");
	}



?>
