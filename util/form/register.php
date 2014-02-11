<?php	

if (isset($_POST['register'])) {
	$username = mysql_real_escape_string($_POST['username']);	
	$password = mysql_real_escape_string($_POST['password']);
	$password2 = mysql_real_escape_string($_POST['password2']);
	$name = mysql_real_escape_string($_POST['name']);
	$time = time()*1000;
	$errors = "";		
	if (!$username || !$password || !$password2 || !$name) {				
		$errors .= "All fields are required.<br />";
	} else {
		$isAvailable = checkUsername($username);
		if (!$isAvailable)
			$errors .= "This username is already in use.<br />";
		if ($password != $password2)
			$errors .= "The passwords do not match.<br />";
		if ($errors == "") {
			$sn = getNextId();
			$password = crypt($password,"@#$%1231adsEER678900SahilPatelisaboss.??.");
			$query = "INSERT INTO users(uid, username, password, name, time) VALUES ($sn, '".$username."', '".$password."', '".$name."', $time )";
			mysql_query($query) or die("Could not register: ".mysql_error());	
			$bidin = getNextBid();
			mysql_query("INSERT into boards(bid, uid, name, time) VALUES(".$bidin++.",".$sn.",'General',".$time.")") or die("Could not add a board: ".mysql_error());
			mysql_query("INSERT into boards(bid, uid, name, time) VALUES(".$bidin++.",".$sn.",'On the go',".$time.")") or die("Could not add a board: ".mysql_error());
			mysql_query("INSERT into boards(bid, uid, name, time) VALUES(".$bidin++.",".$sn.",'Important',".$time.")") or die("Could not add a board: ".mysql_error());
			mysql_query("INSERT into boards(bid, uid, name, time) VALUES(".$bidin++.",".$sn.",'Bookmarks',".$time.")") or die("Could not add a board: ".mysql_error());
		
			$k = randomKey();
			mysql_query("INSERT into live(uid, ukey) VALUES(".$sn.",'".$k."')");
			setcookie("lgn_user_id3",$username,time()+3600);
			setcookie("lgn_pass_id3",$k,time()+3600);
			header("Location:home.php");

			//$errors .= "<font color='green'><b>Perfect!</b> Now you have an account, so feel free to login anytime.</font>";		
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

function getNextId() {
	$a = mysql_query("Select uid from users order by uid desc limit 1") or die("Could not get uid: ".mysql_error());
	if ($b = mysql_fetch_array($a))
		return $b['uid']+1;
	else
		return 1;
}
function getNextBid() {
	$a = mysql_query("Select bid from boards order by bid desc limit 1") or die("Could not get uid: ".mysql_error());
	if ($b = mysql_fetch_array($a))
		return $b['bid']+1;
	else
		return 1;
}
function getUid($a) {
		$b = mysql_query("Select uid from users where username='".$a."'") or die("Failed uid fetch: ".mysql_error());
		if ($c = mysql_fetch_array($b))
			return $c['uid'];
		else
			return 0;
	}


?>