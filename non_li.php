<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Non-teaching','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Non-teaching', $_SERVER['PHP_SELF'], 1);
$trail->output();


$connection= mysql_connect('localhost', 'root', '') or die ('Unable to connect!');
mysql_select_db('clearance') or die ('Unable to select database!');

//Gets the Non-teaching and their respective Advisers
$query = "SELECT des,lname,fname,ot_id FROM signatory, non_teaching WHERE signatant = stid";
$result=mysql_query($query) or die ('Error in query: $query.' . mysql_error());


echo "<p><h1>Non-Teaching</h1></p>";
echo '<table id="table">';
echo
'<tr><th><b>Description</b></th><th><b>Assigned</b></th><th><b>Delete</th></b>';
echo '</tr><form action="delete.php" method="post">';
$count2=0;

//Iterate non-teaching and respective advisers
while ($row = mysql_fetch_row($result))
{

        $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
        echo $tr;
        echo "<td>$row[0]</td>";
        echo "<td>$row[1],$row[2]</td>";
                echo '<td><input type="checkbox" name="delete[]" value="'.$row[3].'"></td>';
        echo '</tr>';
        $count2++;
}
echo '<tr class="button"><td></td><td></td><td><input class="delete" type="submit" name="non_teaching" value="Delete"></td></tr></form>';
echo '</table>';
$clr->footer();
?>