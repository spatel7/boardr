<?php 
	include 'connect.php';
	include 'home_functions.php';

	if($_GET['lastid']){
						
						define( 'LINK_LIMIT', 30 );
						define( 'LINK_FORMAT', '<a href="%s" rel="ext" target="_blank"><font color="#2f71a0">%s</font></a>' );

						function prase_links  ( $m )
						{
   							$href = $name = html_entity_decode($m[0]);
    							if ( strpos( $href, '://' ) === false ) {
        							$href = 'http://' . $href;
    							}
    							if( strlen($name) > LINK_LIMIT ) {
        							$k = ( LINK_LIMIT - 3 ) >> 1;
        							$name = substr( $name, 0, $k ) . '...' . substr( $name, -$k );
    							}
    							return sprintf( LINK_FORMAT, htmlentities($href), htmlentities($name) );
						}
						$reg = '~((?:https?://|www\d*\.)\S+[-\w+&@#/%=\~|])~';

						$time1 = time()*1000; $lastid = 0; $number=mysql_real_escape_string($_GET['numb']); $last_fetch = mysql_real_escape_string($_GET['lastfetch']); 
						$posts = mysql_query("SELECT * FROM posts where last_update < ".mysql_real_escape_string($_GET['lastid'])." and ".getMutes($number)." order by last_update desc limit 5") or die("Failed to fetch posts: ".mysql_error());
						while ($a = mysql_fetch_array($posts)) {
							$lastid = $a['last_update'];
							$bgcolor = "#f8f8f8";
							$bgcolor2 = "#e6e6fa";

							if ($a['last_update'] > $last_fetch) {
								//$bgcolor = "#ffffe3";
							} elseif ($a['last_update'] < $last_fetch) {

							}
							
							echo "<div id='post_c' style='background-color: ".$bgcolor.";'><div id='post_i'><img src='images/icon.jpg' width='40px' height='40px'></div><div id='post_cc' style='background-color: ".$bgcolor.";'>";
							echo "<div style='width:100%; float: left;'><div style='float:left;'><font color='#802da1' face='' style='font-size: 18px;'><font style='font-weight: ;'>".getFullname($a['uid'])."</font> (".getUsername($a['uid']).") said:</font></div><div style='float: right;'><a href='#' id='muters' onclick='javascript:muteuser(".$a['uid'].");'><font color='#b97de0'>Mute user</font></a></div></div>";
							echo "<br><div id='timedesc' style='float: left; margin-top: 3px; margin-bottom: 2px;'><font color='gray' style='font-size: 15px;'>#".$a['pid']." - ".getTime($time1,$a['time'])." - <a id='muters' href='javascript:toggledisplay(\"addcomment\",".$a['pid'].");'><font color='#2f71a0'>Reply</font></a></font></div></div>";
							echo "<div id='' style='float: left; width: 450px;'><font style='font-size: 15px; font-weight: lighter;'>".preg_replace_callback( $reg, 'prase_links', nl2br(htmlspecialchars($a['post'],ENT_QUOTES)) )."</font></div>";	
								/*$comment = mysql_query("SELECT * from comments where pid=".$a['pid']) or die("Could not get comments: ".mysql_error());
								$cnum = 1;
								$hidden = false;
								while ($b = mysql_fetch_array($comment)) {
									if (!isMuted($number,$b['uid'])) {
										if ($cnum == 3) {
											echo "<div id='hider".$a['pid']."' style='width:100%; float: left; display:none;'>";
											$hidden = true;
										}
										echo "<div id='comment' style='background-color:".$bgcolor2.";'><div id='comment_i'><font style='font-size: 15px;'><b>".getUsername($b['uid'])."</b> ".preg_replace_callback( $reg, 'prase_links', nl2br(htmlspecialchars($b['comment'],ENT_QUOTES)) )."</font>";
										echo "<br><font color='gray' style='font-size: 15px;'>#".$cnum++." - ".getFullname($b['uid'])." - ".getTime($time1,$b['time'])." </font>";
										echo "</div></div>";
									}
								}
								if ($hidden) {
									echo "</div>";
									echo "<div id='comment'><div id='comment_i'><a id='muters' href='javascript:document.getElementById(\"hider".$a['pid']."\").style.display=\"block\";'>Show all ".--$cnum." replies</a></div></div>";
								}*/
								$comment = mysql_query("SELECT * from comments where pid=".$a['pid']." and ".getMutes($number)." order by cid desc limit 2") or die("Could not get comments: ".mysql_error());
								$cnum = 1; $lastc = ""; $lastc2 = ""; $lastcid = 0;
								$hidden = false;
								while ($b = mysql_fetch_array($comment)) {
										if ($cnum == 1) {
											$lastc .= "<div id='comment' style='background-color:".$bgcolor2.";'><div id='comment_i'><font style='font-size: 15px;'><b>".getUsername($b['uid'])."</b> ".preg_replace_callback( $reg, 'prase_links', nl2br(htmlspecialchars($b['comment'],ENT_QUOTES)) )."</font>";
											$lastc .= "<br><font color='gray' style='font-size: 15px;'>#".$cnum++." - ".getFullname($b['uid'])." - ".getTime($time1,$b['time'])." </font>";
											$lastc .= "</div></div>";
										}  elseif ($cnum == 2) {
											$lastc2 .= "<div id='comment' style='background-color:".$bgcolor2.";'><div id='comment_i'><font style='font-size: 15px;'><b>".getUsername($b['uid'])."</b> ".preg_replace_callback( $reg, 'prase_links', nl2br(htmlspecialchars($b['comment'],ENT_QUOTES)) )."</font>";
											$lastc2 .= "<br><font color='gray' style='font-size: 15px;'>#".$cnum++." - ".getFullname($b['uid'])." - ".getTime($time1,$b['time'])." </font>";
											$lastc2 .= "</div></div>";
										}
										$lastcid = $b['cid'];
								}
								if ($cnum == 3) {
									$comment2 = mysql_query("SELECT * from comments where pid=".$a['pid']." and ".getMutes($number)." and cid<".$lastcid) or die("Could not get comments: ".mysql_error());
									$hidden = false;
									while ($b = mysql_fetch_array($comment2)) {
											if ($cnum == 3) {
												echo "<div id='hider".$a['pid']."' style='width:100%; float: left; display:none;'>";
												$hidden = true;
											}
											echo "<div id='comment' style='background-color:".$bgcolor2.";'><div id='comment_i'><font style='font-size: 15px;'><b>".getUsername($b['uid'])."</b> ".preg_replace_callback( $reg, 'prase_links', nl2br(htmlspecialchars($b['comment'],ENT_QUOTES)) )."</font>";
											echo "<br><font color='gray' style='font-size: 15px;'>#".$cnum++." - ".getFullname($b['uid'])." - ".getTime($time1,$b['time'])." </font>";
											echo "</div></div>";
									}
								}
								if ($hidden) {
									echo "</div>";
									echo "<div id='hiddens".$a['pid']."' style='display: block;'><div id='comment'><div id='comment_i'><a id='muters' href='javascript:document.getElementById(\"hider".$a['pid']."\").style.display=\"block\"; javascript:document.getElementById(\"hiddens".$a['pid']."\").style.display=\"none\";'>Show all ".--$cnum." replies</a></div></div></div>";
								}
								echo $lastc2;
								echo $lastc;

							echo "<div id='newcommentdiv".$a['pid']."' style='width:390px; float:left;'></div>";
							echo "<div id='addcomment".$a['pid']."' style='display:none; margin-top: 3px; width: 386px; float: left; background-color: #e8e8e8; padding: 2px;'><input type='text' id='newcomment".$a['pid']."' value='' style='width: 320px;' /><input type='button' id='add comment' value='Reply' onclick='javascript:postcomment(".$a['pid'].");'/></div>";
							echo "</div>";
							

echo "<span id='".$lastid."'></span>";
						$lastf = time()*1000;
						$update = "UPDATE users SET last_fetch=".$lastf." WHERE uid=".$number;
						mysql_query($update) or die("Failed update of last fetch: ".mysql_error());

							
						}
						


}



























