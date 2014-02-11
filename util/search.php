<?php
	include 'connect.php';
	include 'cookie_home.php';
	include 'home_functions.php';

	$sid = mysql_real_escape_string($_GET['sid']);
	$bid = mysql_real_escape_string($_GET['bid']);
	$statement = "";
	if ($bid == 0) { } else {
		$statement = "and bid=".$bid;
	}
		
	$counter = 0; $time1=time()*1000;
	$notes = mysql_query("SELECT * from scribbles where uid=".getCurrentUser()." ".$statement." and scribble like '%".$sid."%' order by time desc") or die("Could not get notes: ".mysql_error());
	while ($r = mysql_fetch_array($notes)) {
		$counter++;
		echo "<div id='note'><div id='words'><font color='black'>".preg_replace_callback( $reg, 'prase_links', nl2br(htmlspecialchars($r['scribble'],ENT_QUOTES)) )."</font></div><div style='width: 100%; float: left;'><div id='info'><font color='gray'>".getTime($time1,$r['time'])." - ".getBoardName($r['bid'])."</div><div style='float: right;'><a href='javascript:openOverlay(\"".$r['sid']."\");'><font color='#2f71a0' style='font-size: 14px;'>Open</font></a></font></div></div></div>";
	}
	if ($counter == 0) {
		echo "You have no such notes.";
	}												
?>