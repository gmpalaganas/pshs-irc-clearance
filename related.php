<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$clr = new Clearance('Related', 'signatant');
$trail->add('Related', $_SERVER['PHP_SELF'], 1);
$clr->header();

$id = $_SESSION['id']; //Gets the ID number of current User


mysql_connect('localhost','root','');
mysql_select_db('clearance');

//Gets the ID of related signatories to user
$result = mysql_query("SELECT * FROM related WHERE id1 = $id OR id2 = $id") or die (mysql_error());
$trail->output();

echo '<p><h1>Related</h1></p>';
echo '<table id="table">';
echo '<tr><th>Related Person</th></tr>';
while($val =  mysql_fetch_row($result))
{
    echo '<tr>';
    if($val[0] == $id)
    {
        $new = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM messages WHERE new_msg AND to_id=$id AND from_id=$val[1]"));
        $name = mysql_fetch_row(mysql_query("SELECT lname,fname FROM signatory WHERE stid = $val[1]"));
        echo "<td><a href='message.php?id=$val[1]'>$name[0], $name[1] ($new[0]) </a></td>";
    }
    
    else if($val[1] == $id)
    {
        $new = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM messages WHERE new_msg AND to_id=$id AND from_id=$val[1]"));
        $name = mysql_fetch_row(mysql_query("SELECT lname,fname FROM signatory WHERE stid = $val[0]"));
        echo "<td><a href='message.php?id=$val[0]'>$name[0], $name[1] ($new[0])</a></td>";
    }
    echo '</tr>';
    
}
echo '</table>';
$clr->footer();
?>