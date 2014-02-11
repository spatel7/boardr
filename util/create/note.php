<?php
	include '../connect.php';
	if (isset($_POST['new_note'])) {
		$note = mysql_real_escape_string($_POST['newnote']);
		$bid = mysql_real_escape_string($_POST['boardid']);
		$a = getUid();
		if ($a != 0 && iisMyBoard($bid, $a))
			createNote($note, $bid, $a);
	} else { 
		header("Location:../../home.php");  
	}

	function createNote($a, $b, $c) {
		if ($a == "" || $a == null)
			die("Note has to have some content.");
		$time = time()*1000;	
		$count = mysql_query("SELECT sid FROM scribbles order by sid desc limit 1") or die("Failed retrieval of sid: ".mysql_error());
		$sid = 1;
		while ($d = mysql_fetch_array($count)) {
			$sid = $d['sid']+1;
		}
		$q = "INSERT into scribbles(sid, bid, uid, scribble, time) VALUES(".$sid.",".$b.",".$c.",'".$a."',".$time.")";
		mysql_query($q) or die("Could not insert: ".mysql_error());
		header("Location:../../home.php?b=".$b);
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
?>


