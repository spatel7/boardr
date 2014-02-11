<?php
	function getCurrentUser() {
		$username = mysql_real_escape_string($_COOKIE['lgn_user_id3']);
		$al = mysql_query("SELECT uid FROM users WHERE username='".$username."'") or die("Could not get uid: ".mysql_error());
		while ($a=mysql_fetch_array($al)) {
			return $a['uid'];
		}
		return;
	}
	function isMyBoard($a, $b) {
		$isBoard = false;
		$n = mysql_query("SELECT bid FROM boards WHERE uid=".$a." and bid=".$b);
		while ($n2=mysql_fetch_array($n)) {
			$isBoard = true;
		}
		return $isBoard;
	}
	function getGeneral($a) {
		$n = mysql_query("SELECT bid from boards where uid=".$a." limit 1") or die("Couadlf: ".mysql_error());
		while ($n2 = mysql_fetch_array($n)) {
			return $n2['bid'];
		}
	}

	function getBoardName($a) {
		$boardName = "default";
		$n = mysql_query("SELECT name FROM boards WHERE bid=".$a) or die("Failed to return board name: ".mysql_error());
		while ($n2=mysql_fetch_array($n)) {
			$boardName = $n2['name'];
		}
		return $boardName;
	}
	function getUsername($s) {
		$val = "";
		$n = mysql_query("SELECT username FROM users WHERE uid=".$s) or die("Failed to return username: ".mysql_error());
		while ($n2=mysql_fetch_array($n)) {
			$val = $n2['username'];
		}
		return $val;
	}

	function getFullname($s) {
		$val = "";
		$n = mysql_query("SELECT name FROM users WHERE uid=".$s) or die("Failed to return fullname: ".mysql_error());
		while ($n2=mysql_fetch_array($n)) {
			$val = $n2['name'];
		}
		return $val;
	}

	/*function getProfileInfo($a) {
		$prof = mysql_query("SELECT firstname, lastname, quickbio, time FROM profiles WHERE uid=".$a) or die("Failed to get profile: ".mysql_error());
		$profInfo[] = "";
		while ($b = mysql_fetch_array($prof)) {
			$profInfo[] = { $b['firstname'], $b['lastname'], $b['quickbio'], $b['time'] };

		}
		return $profInfo[];
	}*/

	function getTime($a,$b) {
		$txt;
		$i=$a-$b;
		$j=$i/1000;
		if(floor($j)<10) {
			$txt = "a couple seconds ago";
		}
		elseif (floor($j)<60) {
			$sp = floor($j);
			if ($sp == 1) {
			$txt = $sp." second ago";
			} else {
				$txt = $sp." seconds ago";
			}
		}
		elseif(floor($j/60)<60) {
			$sp = floor($j/60);
			if ($sp == 1) {
			$txt = $sp." minute ago";
			} else {
				$txt = $sp." minutes ago";
			}		}
		elseif (floor($j/3600)<24) {
			$sp = floor($j/3600);
			if ($sp == 1) {
			$txt = $sp." hour ago";
			} else {
				$txt = $sp." hours ago";
			}		}
		else {
			$sp = floor($j/86400);
			if ($sp == 1) {
			$txt = $sp." day ago";
			} else {
				$txt = $sp." days ago";
			}		}
	
		return $txt;
	}

function val($a) {
		$isreal = false;
		$uid = mysql_real_escape_string($a);
		$b=mysql_query("Select * from online where ukey='".$uid."'") or die("Could not select:".mysql_error());
		if ($c=mysql_fetch_array($b)) {
			$isreal = true;
		}
		return $isreal;
	}
	function randomKey() {
	$chars;
	$chars[0] = "a";
	$chars[1] = "A";
	$chars[2] = "b";
	$chars[3] = "B";
	$chars[4] = "c";
	$chars[5] = "C";
	$chars[6] = "d";
	$chars[7] = "D";

	$chars[8] = "e";
	$chars[9] = "E";
	$chars[10] = "f";
	$chars[11] = "F";
	$chars[12] = "g";
	$chars[13] = "G";
	$chars[14] = "h";
	$chars[15] = "H";

	$chars[16] = "i";
	$chars[17] = "I";
	$chars[18] = "j";
	$chars[19] = "J";
	$chars[20] = "k";
	$chars[21] = "K";

	$chars[22] = "l";
	$chars[23] = "L";
	$chars[24] = "m";
	$chars[25] = "M";
	$chars[26] = "n";
	$chars[27] = "N";

	$chars[28] = "o";
	$chars[29] = "O";
	$chars[30] = "p";
	$chars[31] = "P";
	$chars[32] = "q";
	$chars[33] = "Q";

	$chars[34] = "r";
	$chars[35] = "R";
	$chars[36] = "s";
	$chars[37] = "S";
	$chars[38] = "t";
	$chars[39] = "T";


	$chars[40] = "u";
	$chars[41] = "U";
	$chars[42] = "v";
	$chars[43] = "V";
	$chars[44] = "w";
	$chars[45] = "W";

	$chars[46] = "x";
	$chars[47] = "X";
	$chars[48] = "y";
	$chars[49] = "Y";
	$chars[50] = "z";
	$chars[51] = "Z";


	$chars[52] = "0";
	$chars[53] = "1";
	$chars[54] = "2";
	$chars[55] = "3";
	$chars[56] = "4";
	$chars[57] = "5";

	$chars[58] = "6";
	$chars[59] = "7";
	$chars[60] = "8";
	$chars[61] = "9";


	$text = "";
	$limit = rand(12,17);
	for($i=0; $i<$limit; $i++) {
		$j = rand(0, 61);
		$text.=$chars[$j];
	}
	return $text;
	}





?>