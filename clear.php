<?php
$connect = mysql_connect('localhost','root','') or die ("Unable to Connect!");
mysql_select_db('clearance') or die ("Unable to Select Database");

$table= ' ';
$head = ' ';
$id = ' ';

/* Checks if being cleared is a subject, a non-teaching, a club, or a section
 * $table refers to what table in the database is to be UPDATED
 * $head refers to filename of the page where the user is redirected after instructions are finished
 * $id refers to the fieldname of the ID number of the entity being cleared
 */
if(isset($_POST['subjects']))
{
    $table= 'st_subjects';
    $head = 'sig_sect_sub';
    $id = 'sub_id';
}
if(isset($_POST['non']))
{
    $table= 'st_non_teaching';
    $head = 'sig_sect_non';
    $id = 'ot_id';
}
if(isset($_POST['clubs']))
{
    $table= 'clubs';
    $head = 'sig_sec_clubs';
    $id = 'clid';
}
if(isset($_POST['sec']))
{
    $table= 'st_sec';
    $head = 'advisory';
    $id = 'secid';
}

$query = "UPDATE $table  SET cleared ='CLEARED', date_signed = NOW(),notif=1, year=(SELECT DATE_FORMAT(NOW(),'%Y'))";
$clear = $_POST['clear'];
$id2 = $_POST['id'];

//Selected students are cleared
for($count=0;$count<sizeof($clear);$count++)
{
    $id3 = $id2[$count];
    echo $query." WHERE $id = $id3 AND stid =  " .$clear[$count];
    $result = mysql_query($query." WHERE $id = $id2[$count] AND stid ='$clear[$count]'") or die('<br>Error in query : '. mysql_error());
    echo $query." WHERE $id = $id2[$count] AND stid ='$clear[$count]'";
}
header("location:$head.php");
?>
