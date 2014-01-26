<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$clr = new Clearance('Subjects','');
$clr->header();
$trail->add('Subjects', $_SERVER['PHP_SELF'], 1);
$trail->output();


$connection= mysql_connect('localhost', 'root', '')or die ('Unable to connect!');
mysql_select_db('clearance') or die ('Unable to select database!');

//Gets the Non-teaching and their respective Advisers
$query = "SELECT sub, signatory.lname, signatory.fname,yrlevel,sub_id FROM subjects,signatory WHERE teacher=stid ORDER BY yrlevel,sub";
$result=mysql_query($query) or die ('Error in query: $query.' . mysql_error());


echo "<p><h1>Subjects</h1></p>";
echo '<table id="table">';
echo
'<tr><th><b>Subject</b></th><th><b>Year Level</b></th><th><b>Teacher</b></th><th><b>Delete</th></b>';
echo '</tr><form action="delete.php" method="post">';
$count2=0;

//Iterate non-teaching and respective advisers
while ($row = mysql_fetch_row($result))
{

        $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
        echo $tr;
        echo "<td>$row[0]</td>";
        echo "<td>$row[3]</td>";
        echo "<td>$row[1],$row[2]</td>";
        echo '<td><input type="checkbox" name="delete[]" value="'.$row[4].'"></td>';
        echo '</tr>';
        $count2++;
}
echo '<tr class="button"><td></td><td></td><td></td><td><input class="delete" type="submit" name="subject" value="Delete"></td></tr></form>';
echo '</table>';
$clr->footer();
?>