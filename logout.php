<?php
	include 'util/connect.php';
	$k = mysql_real_escape_string($_COOKIE['lgn_pass_id3']);
	$uid = 0;
	$a = mysql_query("Select uid from live where ukey='".$k."'") or die("Could not get ukey logout: ".mysql_error());
	if ($b = mysql_fetch_array($a)) {
		$uid = $b['uid'];
	}
	if ($uid != 0) {
		mysql_query("Delete from live where uid='".$uid."'") or die("Could not logout: ".mysql_error());
	} else {  }

	$time = time() - 3600;
	setcookie("lgn_user_id3",gone,$time);
	setcookie("lgn_pass_id3",gone,$time);

	header("Location:index.php");
?>