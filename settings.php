<?php
	include "util/connect.php";
	include "util/cookie_home.php";
	include "util/home_functions.php";
	include "util/form/settings.php";


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Boardr - your notes, nothing more</title>
		<link rel="shortcut icon" href="favicon.ico" />
		<script type="text/javascript" src="head/scripts.js"></script>


		<link type="text/css" rel="stylesheet" href="head/structure.css" />
		<?php include "tracker.php";?>

	</head>
	<body>
		<div id='main'>
			<?php include "common_head.php"; ?>
			<div id='content'>
				<div id='left' style='width: 100%;'>
					<font size='2' face='verdana,news gothic,arial,heltevica,serif'>
						<b>Username</b><br>
						<table width='500px'>
							<tr>
								<td width='200px'>
									<?php echo getUsername($number); ?>
								</td>
								<td width='300px'>
									<a href="javascript:toggledisplay('username_change','');">Change username</a>										
								</td>
							</tr>
						</table>
						<b>Password</b><br>
						<table width='500px'>
							<tr>
								<td width='200px'>
									*******
								</td>
								<td width='300px'>
									<a href="javascript:toggledisplay('password_change','');">Change password</a>										
								</td>
							</tr>
						</table>
						<div id='errors'>
							<font face='verdana' color='red'><?php echo $errors;?></font>
						</div>
						<div id='username_change' style='display:none;'>
							<form action='<?php echo $_SERVER['self']; ?>' method='post' name='usrchng'>
								<input type='text' name='new_username' value='<?php echo getUsername($number); ?>' style='width: 200px;'>
								<input type='submit' value='Change' name='user_change' style='width: 90px; background-color: #f8f8f8; ; color: black;'/>
							</form>
						</div>
						<div id='password_change' style='display:none;'>
							<form action='<?php echo $_SERVER['self']; ?>' method='post' name='passchng'>
								Old password: <input type='password' name='old_passname' value='' style='width: 200px;'><br>
								New password: <input type='password' name='new_passname' value='' style='width: 200px;'><br>
								Confirm new password: <input type='password' name='new_passname_c' value='' style='width: 200px;'><br>
								<input type='submit' value='Change' name='pass_change' style='width: 90px; background-color: #f8f8f8; ; color: black;'/>
							</form>
						</div>
					</font>	
				</div>	
			</div>
		</div>
	</body>
</html>