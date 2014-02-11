<?php
	include '../connect.php';
	include '../cookie_home.php';
	include '../home_functions.php';

	$nid = mysql_real_escape_string($_GET['nid']);

	$a = getUid();
	if ($a != 0 && isMyNote($nid, $a))
		deleteNote($nid);

	echo "Done.";
	
	function isMyNote($a, $b) {
		$c = mysql_query("Select sid from scribbles where sid=".$a." and uid=".$b) or die("Could not check note: ".mysql_error());
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
	function deleteNote($a) {
		$b = mysql_query("DELETE from scribbles WHERE sid=".$a) or die("Could not delete note: ".mysql_error());
	}														

?>