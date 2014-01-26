<?php
	mysql_connect('localhost','root','');
	mysql_select_db('clearance');
        
	$stid = $_GET['stid']; //Student ID
	$subid = $_GET['subid']; //Subject,Non-teaching,Club or Section ID
        
	$comment = mysql_escape_string($_POST['comment']);
	$type = $_SESSION['type'];
        
        //Sets the comment of the signatory to the student
	switch($type)
	{
	case 0: mysql_query("UPDATE st_subjects SET comments='$comment', notif = 1 WHERE stid='$stid' AND sub_id='$subid'") or die ('ERROR'); break;
	case 1: mysql_query("UPDATE st_non_teaching SET comments='$comment', notif = 1 WHERE stid='$stid' AND ot_id='$subid'") or die ('ERROR'); break;
	case 2: mysql_query("UPDATE st_clubs SET comments='$comment', notif = 1 WHERE stid='$stid' AND cliid='$subid'") or die ('ERROR'); break;
	case 3: mysql_query("UPDATE st_sec SET comments='$comment', notif = 1 WHERE stid='$stid' AND secid='$subid'") or die ('ERROR'); break;
	}
	header("location:st_comments.php?stid=$stid&subid=$subid");
?>
