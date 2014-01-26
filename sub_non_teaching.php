<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Announcement','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Announcement', $_SERVER['PHP_SELF'], 2);
$trail->output();

//Gets the selected Non-teaching
$sub = $_GET['non'];


mysql_connect('localhost','root','') or die ('Unable to connect');
mysql_select_db('clearance');

//Gets the Announcement for the selected non-teaching
$result = mysql_query("SELECT announce,post_date FROM non_teaching WHERE ot_id = '$sub'") or die ("Error in query: $query." . mysql_error());
$subject = mysql_fetch_row($result);


echo '<p><h1>Announcement</h1></p><textarea rows="18" cols="80" readonly>'."$subject[0]</textarea><br>$subject[1]";
$clr->footer();
?>