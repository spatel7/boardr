<?php
	include "util/connect.php";
	include "util/cookie_index.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Boardr - your notes, nothing more</title>
		<link rel="shortcut icon" href="favicon.ico" />
		<link type="text/css" rel="stylesheet" href="head/structure.css" />
		<?php include "tracker.php";?>
	</head>
	<body>
		<div id='main'>
			<?php include "common.php"; ?>
			<div id='content'>
				<font size='4'>Welcome to <b>Boardr</b>, your own private place in the cloud!<br>To proceed, <a href='login.php'><font color='blue'>login</font></a> to your account or <a href='register.php'><font color='blue'>register</font></a> for a new one.</font>
			</div>
		</div>
	</body>
</html>