<?php
	$con = mysql_connect("localhost","root","toothpicks") or die("Failed connection: ".mysql_error());
	mysql_select_db("boardr", $con) or die("Failed db selection: ".mysql_error());
?>