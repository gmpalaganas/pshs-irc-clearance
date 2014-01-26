<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Alumni','administrator');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Alumni', $_SERVER['PHP_SELF'], 1);
$trail->output();

//Gets the Selected batch
$batch = (isset($_GET['batch']))?$_GET['batch']:$_SESSION['batch'];
$_SESSION['batch'] = $batch;

mysql_connect('localhost','root','');
mysql_select_db('clearance');

//Gets the student information of the students in the selected batch
$query="SELECT stid,lname,fname FROM students WHERE yrlevel = $batch";
$students = mysql_query($query) or die (mysql_error());
$count2 = 0;
echo "<p><h1>Batch $batch<h1></p>";
echo '<table id="table">';
echo "<tr><th>ID</th><th>Last Name</th><th>First Name</th></tr>";
while($row = mysql_fetch_row($students))
{
        $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
        echo $tr;
        echo '<td><a href ="profile.php?stid='.$row[0].'&alumni=1">'.$row[0].'</td>';
        for($count=1;$count<sizeof($row);$count++)
                echo "<td>$row[$count]</td>";
        echo '</tr>';
}
echo '</table>';
$clr->footer();
?>