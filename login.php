<?php
	include "util/connect.php";
	include "util/cookie_index.php";
	include "util/generator.php";
	include "util/form/login.php";

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
					<b>Login to your Boardr account.</b><br>  
				
					<form action='<?php echo $_SERVER['SELF'];?>' method='post' name='reg'>
						<table width='500px'>
							<tr>
								<td width='150px'>
									Username:
								</td>
								<td width='300px'>
									<input type='text' name='username' value='' style='width: 290px;'>
								</td>
							</tr>
							<tr>
								<td width='150px'>
									Password:
								</td>
								<td width='300px'>
									<input type='password' name='password' value='' style='width: 290px;'>
								</td>
							</tr>
							<tr>
								<td width='150px' valign='top'>
									<input type='submit' name='login_attempt' value='Login!' style='width: 140px; background-color: #f8f8f8; ; color: black; height: 50px;' />
								</td>
								<td width='300px'>
									By clicking login, you are entering a world of awesomeness.										
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