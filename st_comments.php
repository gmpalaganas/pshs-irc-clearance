<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Comment','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Comment', $_SERVER['PHP_SELF'], 3);
$trail->output();
?>
<p><h1>Comment</h1></p>
<?php

//Gets the ID number of the selected student
$stid = $_GET['stid'];

//Gets the ID number of the selected subject, non-teaching, club or section
$subid = $_GET['subid'];


mysql_connect('localhost','root','');
mysql_select_db('clearance');

//Gets whether a subject, non-teaching, club or section was selected
$type = (isset($_GET['type']))?$_GET['type']:$_SESSION['type'];
$_SESSION['type'] = $type;

//Checks what type was selected
if($type==0){
        $comment = mysql_fetch_row(mysql_query("SELECT comments FROM st_subjects WHERE stid='$stid' AND sub_id = '$subid'"));
        echo '<form action="comment.php?subid='.$subid.'&stid='.$stid.'&type=0" method="post">';}
else if($type==2){
        $comment = mysql_fetch_row(mysql_query("SELECT comments FROM st_non_teaching WHERE stid='$stid' AND ot_id = '$subid'"));
        echo '<form action="comment.php?subid='.$subid.'&stid='.$stid.'&type=1" method="post">';}
else if($type==1){
        $comment = mysql_fetch_row(mysql_query("SELECT comments FROM st_clubs WHERE stid='$stid' AND clid = '$subid'"));
        echo '<form action="comment.php?subid='.$subid.'&stid='.$stid.'&type=2" method="post">';}
else if($type==3){
        $comment = mysql_fetch_row(mysql_query("SELECT comments FROM st_sec WHERE stid='$stid' AND secid = '$subid'"));
        echo '<form action="comment.php?subid='.$subid.'&stid='.$stid.'&type=3" method="post">';}
?>
<div class="select">
<?php
echo '<textarea name="comment" rows="15" cols="50">'.$comment[0];
?>
</textarea><br>
<input type="submit">
<input type="reset">
</div>
<?php
$clr->footer();
?>