<?php
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
