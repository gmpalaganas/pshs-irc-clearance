<?php

include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$clr = new Clearance('Related', '');
$trail->add('Related', $_SERVER['PHP_SELF'], 1);
$clr->header();
$trail->output();

mysql_connect('localhost','root','');
mysql_select_db('clearance');

//Gets all the signatories in the database
$query = "SELECT stid,lname,fname FROM signatory";
$result = mysql_query($query);

echo "<h1>Set Relationship</h1>";
echo "<table id='table'><tr><th>Signatory 1</th><th>Signatory 2</th></tr><tr>";
echo "<form action='set_related.php' method='post'><td>";

//Iterates extracted signatories into two drop down lists
echo "<select name='id1'>";
while($val = mysql_fetch_row($result))
{
    echo "<option value='$val[0]'>$val[1],$val[2]</option>";
}
echo "</select></td>";

$result = mysql_query($query);
echo "<td><select name='id2'>";
while($val = mysql_fetch_row($result))
{
    echo "<option value='$val[0]'>$val[1],$val[2]</option>";
}


echo "</select></td>";

echo " </tr>
<tr><td colspan=2><input type='submit' name='sub'/></td></tr></form>    
</table>";

//Adds the new relation to the database
if(isset($_POST['sub']))
{
    $id1 = $_POST['id1'];
    $id2 = $_POST['id2'];
    if($id1 == $id2){ //Checks if the drop down list has the same selected value
        echo '<script type="text/javascript">alert("Cannot relate same signatory");</script>';
    }
    
 else {
        mysql_query("INSERT INTO related values ($id1,$id2)");
    }
}
$clr->footer();
?>