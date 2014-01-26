<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Record','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Record', $_SERVER['PHP_SELF'], 4);
$trail->output();

echo '<p><h1>Alumni</h1></p>';

mysql_connect('localhost','root','');
mysql_select_db('clearance');

$query = "SELECT DISTINCT yrlevel FROM students WHERe yrlevel > 4"; //Gets the alumni batches

$batch = mysql_query($query);
        echo '<table id="table">';
        echo '<tr><th>Batch</th></tr>';
        $count2=0;
        
        
while($row = mysql_fetch_row($batch))//Iterate the alumni batches
{
        $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
        echo $tr;
        echo '<td><a href="alumni.php?batch='.$row[0].'">'.$row[0].'</a></td></tr>';
}
echo '</table>';
$clr->footer();
?>