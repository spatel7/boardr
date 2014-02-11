<?php
	$errors = "";
	if (isset($_POST['user_change'])) {
		$username = mysql_real_escape_string($_POST['new_username']);
		if ($username == "" || $username == null) {
			$errors .= "Field is required.";
		} else { 
			if (!checkUsername($username))
				$errors .= "Username is not available.";
			if ($errors == "") {
				mysql_query("UPDATE users set username='".$username."' where uid=".$number) or die("Failed to update username: ".mysql_error());
				setcookie("lgn_user_id3",$username,time()+3600);
				$errors .= "<font color='green' face='verdana'>Username change successful.</font>";
			}
		}
	}

	if (isset($_POST['pass_change'])) {
		$old = mysql_real_escape_string($_POST['old_passname']);
		$new = mysql_real_escape_string($_POST['new_passname']);
		$newc = mysql_real_escape_string($_POST['new_passname_c']);

		if ($old == "" || $old == null || $new == "" || $new == null || $newc == "" || $newc == null) {
			$errors .= "All fields are required.";
		} else {
			if (!isCorrect($old, $number)) 
				$errors .= "Old password is wrong.<br/>";
			if ($new != $newc)
				$errors .= "New passwords do not match.<br/>";
			if ($errors == "") {
				mysql_query("UPDATE users SET password='".crypt($new,"@#$%1231adsEER678900SahilPatelisaboss.??.")."' where uid=".$number) or die("Failed to change password: ".mysql_error());
				$errors .= "<font color='green' face='verdana'>Password change successful.</font>";
			}
		}
	}





function checkUsername($a) {
	$b = mysql_query("Select username from users where username='".$a."'") or die("Failed to check username: ".mysql_error());
	if ($c = mysql_fetch_array($b))	
		return false;
	else
		return true;
}

function isCorrect($a,$f) {
	$b = crypt($a,"@#$%1231adsEER678900SahilPatelisaboss.??.");
	$c = mysql_query("SELECT password FROM users WHERE uid=".$f) or die("Failed to fetch old password: ".mysql_error());
	if ($d = mysql_fetch_array($c)) {
		if ($b == $d['password'])
			return true;
		else
			return false;
	} else {
		return false;
	}	
}