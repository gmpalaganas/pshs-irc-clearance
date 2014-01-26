<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Announce Clubs','signatant');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Announce Clubs', $_SERVER['PHP_SELF'], 1);
$trail->output();
?>
<p><h1>Clubs</h1></p>
<table id="table">
<tr>
<th><b>Clubs</b></th>
</tr><tr>

<?php

//Gets the ID number of current user
$id = $_SESSION['id'];


mysql_connect('localhost','root','');
mysql_select_db('clearance');

//Gets the number of clubs the user handles
$query="SELECT COUNT(*) FROM clubs WHERE adviser = '$id'";
$count = mysql_fetch_array(mysql_query($query));


if($count[0]!=0) //If user is handling any club
{
//Gets all the clubs handled by the user
$query="SELECT club_id,club FROM clubs WHERE adviser = '$id' ORDER BY clubs";
$result = mysql_query($query);

$count2=0;

while ($row = mysql_fetch_row($result))
{
        $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
        echo $tr;
        echo '<td><a href ="club_comment.php?sub='.$row[0].'">'.$row[1].'</td></tr>';
        $count2++;
}
}
else
    echo "<td>You do not hold any club</td>";
echo "</tr></table>";
$clr->footer();
?>
