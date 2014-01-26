<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Sections','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Sections', $_SERVER['PHP_SELF'], 1);
$trail->output();
?>

<p><h1>Sections</h1></p>
<table id="table">
<tr>
<th>ID</th>
<th>Name</th>
<th>Year Level</th>
</tr><tr>
<?php
$connect=mysql_connect('localhost','root','') or die ('Unable to connect');
mysql_select_db('clearance') or die ('Unable to select');
$id= $_SESSION['id'];
$query= "SELECT stid,lname,fname,yrlevel FROM students ORDER BY yrlevel,stid ";
$result=mysql_query($query) or die ('Error in query: $query.' . mysql_error());
$count2=0;
while ($row = mysql_fetch_row($result))
{
        $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
        echo $tr;
        echo '<td><a href ="students.php?secid='.$row[0].'">'.$row[0]."</td><td>$row[1], $row[2]</td><td>$row[3]</td></tr>";
        $count2++;
}
echo "</table>";
$clr->footer();
?>