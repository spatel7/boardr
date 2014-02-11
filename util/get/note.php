<?php
	include '../connect.php';
	include '../cookie_home.php';
	include '../home_functions.php';

	$sid = mysql_real_escape_string($_GET['sid']);
	$a = getUid();
	if ($a != 0 && isMyNote($sid, $a))
		getNote($sid);

	function getNote($a) {
		include '../link_catch.php';
		$time1 = time()*1000;
		$notes = mysql_query("SELECT * from scribbles where sid=".$a) or die("Could not get notes: ".mysql_error());
		while ($r = mysql_fetch_array($notes))
			echo "<div><div><font color='black' style='font-size: 17px;'>".preg_replace_callback( $reg, 'prase_links', nl2br(htmlspecialchars($r['scribble'],ENT_QUOTES)) )."</font></div><div style='margin-top: 15px; width: 100%; float: left;'><div style='float: left; max-width: 90%;'><font color='gray'>".getTime($time1,$r['time'])." - ".getBoardName($r['bid'])."</font></div><div style='float: right;'><a id='muters' href='javascript:closeOverlay();'><font color='#410041'><b>Close this box</b></font></a></div></div></div>";																				
	}
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
?>
