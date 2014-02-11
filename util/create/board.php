<?php
	include "../connect.php";
	if (isset($_POST['new_board'])) {
		$board = mysql_real_escape_string($_POST['newboard']);
		$time = time()*1000;	
		$number = 0;
		if ($board == "" || $board == null || $board=="New Board") {
			die("Board has to have a name.");
		}
		
		$username = mysql_real_escape_string($_COOKIE['lgn_user_id3']);
		$al = mysql_query("SELECT uid FROM users WHERE username='".$username."'") or die("Could not get uid: ".mysql_error());
		while ($a=mysql_fetch_array($al)) {
			$number = $a['uid'];
		}

		if ($number == 0) {
			die("Something is messed up.");
		}
	

		$count = mysql_query("SELECT bid FROM boards order by bid desc limit 1") or die("Failed retrieval of pid: ".mysql_error());
		$bid = 1;
		while ($a = mysql_fetch_array($count)) {
			$bid = $a['bid']+1;
		}

		$q = "INSERT into boards(bid, uid, name, time) VALUES(".$bid.",".$number.",'".$board."',".$time.")";
		mysql_query($q) or die("Could not insert: ".mysql_error());
		header("Location:../../home.php?b=".$bid);


		
	
	} else { header("Location:../../home.php");  } 
?>


	