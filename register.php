<?php
	include "util/connect.php";
	include "util/cookie_index.php";
	include "util/generator.php";
	include "util/form/register.php";

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
				<font size='2' face='verdana,news gothic,arial,heltevica,serif'>
					<b>Register for a new Boardr account.</b><br>  
					
					<form action='<?php echo $_SERVER['SELF'];?>' method='post' name='reg'>
						<table width='500px'>
							<tr>
								<td width='200px'>
									Full name:
								</td>
								<td width='300px'>
									<input type='text' name='name' value='' style='width: 290px;'>
								</td>
							</tr>
							<tr>
								<td width='200px'>
									Desired username:
								</td>
								<td width='300px'>
									<input type='text' name='username' value='' style='width: 290px;'>
								</td>
							</tr>
							<tr>
								<td width='200px'>
									Password:
								</td>
								<td width='300px'>
									<input type='password' name='password' value='' style='width: 290px;'>
								</td>
							</tr>
							<tr>
								<td width='200px'>
									Confirm password:
								</td>
								<td width='300px'>
									<input type='password' name='password2' value='' style='width: 290px;'>
								</td>
							</tr>
							<tr>
								<td width='200px' valign='top'>
									<input type='submit' name='register' value='Sign up!' style='width: 190px; background-color: #f8f8f8; ; color: black; height: 50px;' />
								</td>
								<td width='300px'>
									By clicking submit, I am agreeing to the <a href='#'>Terms of Service</a> of Boardr Inc, and I am joining the coolest website on the Internet.										
								</td>
							</tr>
						</table>
					</form>
					<div id='errors'>
						<font color='red' face='verdana'><?php echo $errors; ?></font>
					</div>
				</font>
			</div>
		</div>
	</body>
</html>