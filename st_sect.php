<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Sections','administrator');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Sections', $_SERVER['PHP_SELF'], 1);
$trail->output();
?>
<p><h1>Sections</h1></p>
<table id="table">
<tr>
<th>Sections</th>
<th>Adviser</th>
</tr><tr>
<?php

$suc = isset($_GET['suc'])?$_GET['suc']:'false';

if ($suc=='true')
        echo '<script type="text/javascript">alert("Success: Set all to NOT CLEAR")</script>';

$connect=mysql_connect('localhost','root','') or die ('Unable to connect');
mysql_select_db('clearance') or die ('Unable to select');

//Gets the sections and their respective advisers
$query= "SELECT secid,section,lname,fname FROM sections JOIN signatory ON stid = adviser_id";
$result=mysql_query($query) or die ('Error in query: $query.' . mysql_error());


$count2=0;


//Iterates the extracted Sections and respective Advisers
while ($row = mysql_fetch_row($result))
{
        $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
        echo $tr;
        echo '<td><a href ="students.php?secid='.$row[0].'">'.$row[1]."</td><td>$row[2], $row[3]</td></tr>";
        $count2++;
}


echo '<tr class="button"><td><a href="unclear.php">Set all to "NOT CLEAR"</a></td><tr>';
echo '</table>';
$clr->footer();
?>