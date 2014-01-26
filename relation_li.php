<?php
include('include/clearance.php');
include("breadcrumbs.php");
$trail = new Breadcrumb();
$clr = new clearance('Relation List', 'administrator');
$trail->add('Relation List', $_SERVER['PHP_SELF'], 1);
$clr->header();
$trail->output();

mysql_connect('localhost','root','');
mysql_select_db('clearance');

echo "<p><h1>Relations</h1></p>";

//Get the relations
$query = "SELECT * FROM related";
$result = mysql_query($query);

echo "<table id='table'>";
echo "<tr><th>Signatory1</th><th>Signatory2</th><th>Delete</th></tr>";
echo '<form action="delete_rel.php" method="post">';


while($row = mysql_fetch_row($result))
{
    //Get the signatories involved
    $query = "SELECT lname, fname FROM signatory WHERE stid = $row[0]";
    $result = mysql_query($query);
    $st1 = mysql_fetch_array($result);
    
    $query = "SELECT lname, fname FROM signatory WHERE stid = $row[1]";
    $result = mysql_query($query);
    $st2 = mysql_fetch_array($result);
   
    $array = array($row[0],$row[1]);
    
    echo "<tr><td>$st1[0], $st1[1]</td><td>$st2[0], $st2[1]</td>";
     echo '<td><input type="checkbox" name="delete[]" value="'.$row[2].'"></td></tr>';
}

echo '<tr class="button"><td><input class="delete" type="submit"  value="Delete" colspan=6></td></tr></form>';
echo "</table>";

$clr->footer();
?>