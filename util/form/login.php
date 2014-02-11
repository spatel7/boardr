<?php

if (isset($_POST['login_attempt'])) {
	$username = mysql_real_escape_string($_POST['username']);
	$password = mysql_real_escape_string($_POST['password']);
	$errors = "";

	if (!$username || !$password) {
		$errors .= "All fields are required.<br />";	
	} else {
		if (!isValid($username, $password)) {
			$errors .= "Username and password combination is incorrect.<br />";
		} else {
			$k = randomKey();
			$uid = getUid($username);
			mysql_query("INSERT into live(uid, ukey) VALUES(".$uid.",'".$k."')");
			setcookie("lgn_user_id3",$username,time()+3600);
			setcookie("lgn_pass_id3",$k,time()+3600);
			$general = getgeneral($uid);
			header("Location:home.php?b=".$general);
		}
	}
}

function isValid($a, $b) {
	$c = mysql_query("Select password from users where username='".$a."'") or die("Could not get username: ".mysql_error());
	if ($d = mysql_fetch_array($c)) {
		if (crypt($b, "@#$%1231adsEER678900SahilPatelisaboss.??.") == $d['password'])
			return true;
		else
			return false;
	}
}

	function getUid($a) {
		$b = mysql_query("Select uid from users where username='".$a."'") or die("Failed uid fetch: ".mysql_error());
		if ($c = mysql_fetch_array($b))
			return $c['uid'];
		else
			return 0;
	}

	function getgeneral($a) {
		$n = mysql_query("SELECT bid from boards where uid=".$a." limit 1") or die("Couadlf: ".mysql_error());
		while ($n2 = mysql_fetch_array($n)) {
			return $n2['bid'];
		}
	}
?>