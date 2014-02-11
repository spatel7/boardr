<?php
	include "util/connect.php";
	include "util/cookie_home.php";
	include "util/home_functions.php";
	include "util/link_catch.php";
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
				<div id='left'>
					<?php	
						$board = mysql_real_escape_string($_GET['b']);
						if ($board != "" && $board != null && isMyBoard($number, $board)) {
					?>
					<div style='float: left; border: 1px solid #643200; background-color: #371c00; width: 300px; padding: 4px 4px 4px 4px; border-top-left-radius: 2px; border-top-right-radius: 2px;'>
						<div style='float: left; width:260px;'><font color='#f8f8f8'><b><?php echo getBoardName($board);?></b></font></div><div style='float: right; width: 35px;'><a href='javascript:boardDelete(<?php echo $board; ?>);' id='muters'><font color='#f0f0f0' size='2'>Delete</font></a></div>
					</div>	
					<div id='note-maker' style='float: left; display: none; padding: 4px 4px 4px 4px; background-color: #ffffa7; border: 1px solid #cccccc; width: 300px;  position: relative; top:5px; margin-bottom: 5px;'>
						<form action='util/create/note.php' method='post'>
							<textarea name='newnote' id='newnote' style='width: 290px; height: 50px; font-family: arial;'></textarea><br>
							<input type='hidden' name='boardid' value='<?php echo $board;?>' />
							<input type='submit' name='new_note' value='Add note!' />
						</form>
					</div>
					<div id='note_place' style='float: left;'>
						<?php
							$counter = 0; $time1=time()*1000;
							$notes = mysql_query("SELECT * from scribbles where bid=".$board." order by time desc") or die("Could not get notes: ".mysql_error());
							while ($r = mysql_fetch_array($notes)) {
								$counter++;
								echo "<div id='note'><div id='words'><font color='black'>".preg_replace_callback( $reg, 'prase_links', nl2br(htmlspecialchars($r['scribble'],ENT_QUOTES)) )."</font></div><div style='width: 100%; float: left;'><div id='info'><font color='gray'>".getTime($time1,$r['time'])." - ".getBoardName($r['bid'])."</div><div style='float: right;'><a href='javascript:openOverlay(\"".$r['sid']."\");'><font color='#2f71a0' style='font-size: 14px;'>Open</font></a></font></div></div></div>";
							}
							if ($counter == 0)
								echo "You have no notes in this board.";

							echo "</div>";
							} else {
								$board = 0;
								$secondboard = getGeneral($number);
						?>
					<div style='border: 1px solid #643200; background-color: #371c00; width: 300px; padding: 4px 4px 4px 4px; border-top-left-radius: 2px; border-top-right-radius: 2px;'>
						<font color='#f8f8f8'><b>All my notes</b></font>
					</div>
					<div id='note-maker' style='display: none; padding: 4px 4px 4px 4px; background-color: #ffffa7; border: 1px solid #cccccc; width: 300px; margin-top:5px;'>
						<form action='util/create/note.php' method='post'>
							<textarea name='newnote' id='newnote' style='width: 290px; height: 50px; font-family: arial;'></textarea><br>
							<input type='hidden' name='boardid' value='<?php echo $secondboard;?>'>
							<input type='submit' name='new_note' value='Add note!'>
						</form>
					</div>
					<div id='note_place' style='float: left;'>
						<?php
							$counter = 0; $time1=time()*1000;
							$notes = mysql_query("SELECT * from scribbles where uid=".$number." order by time desc") or die("Could not get notes: ".mysql_error());
							while ($r = mysql_fetch_array($notes)) {
								$counter++;
								echo "<div id='note'><div id='words'><font color='black'>".preg_replace_callback( $reg, 'prase_links', nl2br(htmlspecialchars($r['scribble'],ENT_QUOTES)) )."</font></div><div style='width: 100%; float: left;'><div id='info'><font color='gray'>".getTime($time1,$r['time'])." - ".getBoardName($r['bid'])."</div><div style='float: right;'><a href='javascript:openOverlay(\"".$r['sid']."\");'><font color='#2f71a0' style='font-size: 14px;'>Open</font></a></font></div></div></div>";
							}
							if ($counter == 0)
								echo "You have no notes.";
							echo "</div>";
							}
						?>
					<div id='more' style='width:100%; float: left;'></div>
					<div id='loadmoreajaxholder' style='width:100%; float: left;'></div> 
				</div>
				<div id='right'>
					<div id='members' style='border-top-left-radius: 3px; border-top-right-radius: 3px; border-top: 1px solid #c0c0c0;'>
						<input type='text' onfocus="javascript:empty();" onblur="javascript:empty();" onkeyup="javascript:search(<?php echo $board; ?>);" id='search' name='search' value='Search   ' style='width: 170px; height: 17px; border: 1px solid #999999; background-color: white; color: 666666; border-bottom-left-radius: 2px; border-bottom-right-radius: 2px; border-top-left-radius: 2px; border-top-right-radius: 2px; padding: 2px;'>
					</div>
					<div id='members' style='border-bottom-left-radius: 3px; border-bottom-right-radius: 3px; border-bottom: 1px solid #c0c0c0;'>
						<div style='width: 100%; float: left;'><div style='float: left; width: 90px; border: 0px solid black;'><font size='4' face='book antiqua' color='#e8e8e8'><b>Boards</b></font></div><div style='float: right; width: 80px; border: 0px solid black;'><a href="javascript:toggledisplay('board-maker','');" id='muters'><font color='#e8e8e8' size='3'><b>New board</b></font></a></div></div>
						<?php
							$bin = mysql_query("SELECT * FROM boards where uid=".$number) or die("Failed to fetch boards: ".mysql_error());
							while ($b=mysql_fetch_array($bin)) {
								$cl = 'normal';
								$co = '#d8d8d8';
								if ($b['bid'] == $board) {  $cl = 'bold'; $co = '#ffffd9';}
								echo "<a href='?b=".$b['bid']."' id='mutersb' style='font-weight:".$cl.";'><font color='".$co."' id='boar".$b['bin']."'>".$b['name']."</font></a><br>";
							}
						?>
						<div id='board-maker' style='display: none;'>
							<form action='util/create/board.php' method='post'>
								<input type='text' maxsize='40' name='newboard' id='newboard' value='New Board'><br><input type='submit' name='new_board' value='Create board!'>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>

	<div id='contentContainer'></div>
	<div id='holderBox'>
		<div id='contentBox'>
			<form name='asd'>
				<input type='hidden' name='whichNote' id='whichNote' value=''>
			</form>
			<div id='editor' style='display:block;'>
				<a href="javascript:overlayEdit(document.asd.whichNote.value);" id='muters'><font color='#f8f8f8' style='font-size: 17px;'>Edit this note</font></a> - <a href="javascript:noteDelete(document.asd.whichNote.value);" id='muters'><font color='#f8f8f8' style='font-size: 17px;'>Delete</font></a>
			</div>
			<div id='saver' style='display:none;'>
				<a href="javascript:overlayReadSave(document.asd.whichNote.value);" id='muters'><font color='#f8f8f8' style='font-size: 17px;'>Save this note</font></a> - <a href="javascript:overlayRead(document.asd.whichNote.value);" id='muters'><font color='#f8f8f8' style='font-size: 17px;'>Cancel</font></a>
			</div>
			<div id='postStream'>Loading note...</div>
		</div>
	</div>
</html>