<?php	
	if (isset($_COOKIE['lgn_user_id3'])) {
		$username = mysql_real_escape_string($_COOKIE['lgn_user_id3']);
		$k = mysql_real_escape_string($_COOKIE['lgn_pass_id3']);
		$online = false;

		//correct password?
		$check = mysql_query("SELECT uid FROM users WHERE username='".$username."'") or die("Could not check: ".mysql_error());
		while ($info = mysql_fetch_array($check)) {
			/*if ($password != $info['password']) {
				
			}*/
			$u = $info['uid'];
			$a = mysql_query("Select * from live where uid=".$u." and ukey='".$k."'") or die("Could not check online: ".mysql_error());
			while ($b = mysql_fetch_array($a)) {
				$online = true;
			}	
			if ($online) {
				header("Location:home.php");
			} else { }
		}
		
	}

?>