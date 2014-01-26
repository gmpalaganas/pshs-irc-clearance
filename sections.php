<?php

include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$clr = new Clearance('Section', 'student');
$trail->add('Section', $_SERVER['PHP_SELF'], 1);
$clr->header();
$trail->output();

mysql_connect('localhost','root','');
mysql_select_db('clearance');

$id = $_SESSION['id'];//Gets current user's ID number

mysql_query("UPDATE st_sec SET notif = 0 WHERE stid = $id"); //Sets the notification to 0

//Gets Section and current clearance clearance 
$query = "SELECT section, signatory.lname, signatory.fname, cleared, comments FROM (sections JOIN signatory ON stid = adviser_id) JOIN st_sec USING (secid) WHERE st_sec.stid = $id";
$sec = mysql_fetch_array(mysql_query($query));

echo "<h1>Section</h1>";
?>
<table id="table" width ="100%">
    <tr><th>Section</th><th>Cleared</th><th>Comments</th></tr>
    <?php
    echo "<tr><td>$sec[0]</td><td>$sec[3]</td><td>$sec[4]</td></tr>";
    ?>
</table>

<?php
$clr->footer();
?>