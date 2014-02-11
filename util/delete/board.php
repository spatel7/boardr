<?php
	include '../connect.php';
	include '../cookie_home.php';
	include '../home_functions.php';

	$bid = mysql_real_escape_string($_GET['bid']);
	echo "here.";

	$a = getUid();
	if ($a != 0 && iisMyBoard($bid, $a) && notGeneral($bid, $a))
		deleteBoard($bid);

	echo "Done.";
	
	function notGeneral($a, $b) {
		$c = mysql_query("Select bid from boards where uid=".$b." limit 1") or die("Could not check general board: ".mysql_error());
		if ($d = mysql_fetch_array($c)) {
			if ($d['bid'] == $a)
				return false;
			else
				return true;
		}
	}
	function iisMyBoard($a, $b) {
		$c = mysql_query("Select bid from boards where bid=".$a." and uid=".$b) or die("Could not check board: ".mysql_error());
		if ($d = mysql_fetch_array($c))
			return true;
		else
			return false;
	}
	function getUid() {
		$username = mysql_real_escape_string($_COOKIE['lgn_user_id3']);
		$a = mysql_query("SELECT uid FROM users WHERE username='".$username."'") or die("Could not get uid: ".mysql_error());
		if ($b=mysql_fetch_array($a))
			return $b['uid'];
		else
			return 0;
	}
	function deleteBoard($a) {
		$b = mysql_query("Select nid from notes where bid=".$a) or die("Could not collect notes: ".mysql_error());
		while ($c = mysql_fetch_array($b))
			deleteNote($c['sid']);

		$d = mysql_query("DELETE from boards WHERE bid=".$a) or die("Could not delete board: ".mysql_error());
	}														
	function deleteNote($a) {
		$b = mysql_query("DELETE from notes WHERE nid=".$a) or die("Could not delete note: ".mysql_error());
	}	
