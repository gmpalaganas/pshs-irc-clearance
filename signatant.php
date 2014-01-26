<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Home','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Signatory', $_SERVER['PHP_SELF'], 1);
$trail->output();

$connection= mysql_connect('localhost', 'root', '') or die ('Unable to connect!');
mysql_select_db('clearance') or die ('Unable to select database!');

//Gets the data of signatories in the database
$query = "SELECT * FROM signatory_view";
$result=mysql_query($query) or die ('Error in query: $query.' . mysql_error());


echo "<p><h1>Signatory</h1></p>";
echo '<table id="table">';
echo
'<tr><th><b>ID</b></th><th><b>Last Name</b></th><th><b>First Name</b><th><b>Middle Name</b><th><b>Delete</th></b>';
echo '</tr>';
$count2=0;

//Iterates the extracted signatory data
while ($row = mysql_fetch_row($result))
{

        $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
        echo $tr;
        for($count=0;$count<sizeof($row);$count++)
                echo "<td>$row[$count]</td>";
        if($_SESSION['role']=='administrator')
                echo '<td><form action="delete.php" method="post"><input type="checkbox" name="delete[]" value="'.$row[0].'"></td>';
        echo '</tr>';
        $count2++;
}
echo '<tr class="button"><td></td><td></td><td></td><td></td><td><input class="delete" type="submit" name="students" value="Delete"></td></tr></form>';
echo '</table>';
$clr->footer();
?>