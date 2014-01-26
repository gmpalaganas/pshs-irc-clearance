<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Students','administrator');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Students', $_SERVER['PHP_SELF'], 2);
$trail->output();

//Gets the ID of the selected Section
$secid=(!isset($_GET['secid'])? $_SESSION['secid']:$_GET['secid']);
$_SESSION['secid'] = $secid;


$connection= mysql_connect('localhost', 'root', '') or die ('Unable to connect!');
mysql_select_db('clearance') or die ('Unable to select database!');

//Gets the name of the selected section
$section = mysql_fetch_row(mysql_query("SELECT section FROM sections WHERE secid = '$secid'"));

//Gets the students in the selected section
$query = "SELECT students.stid,lname,fname,students.yrlevel,sections.section FROM students,sections,st_sec WHERE students.yrlevel <=4 AND st_sec.secid=$secid AND  students.stid = st_sec.stid AND st_sec.secid = sections.secid ORDER BY stid ASC";
$result=mysql_query($query) or die ('Error in query: $query.' . mysql_error());


echo "<p><h1>$section[0]</h1></p>";
echo '<table id="table">';
echo
'<tr><th><b>Student ID</b></th><th><b>Last Name</b></th><th><b>First Name</b><th><b>Year Level</b></th><th><b>Section</b></th><th><b>Delete</th></b>';
echo '</tr>';
$count2=0;

//Iterate the extracted students
while ($row = mysql_fetch_row($result))
{

        $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
        echo $tr;
        echo '<td><a href ="profile.php?stid='.$row[0].'">'.$row[0].'</td>';
        for($count=1;$count<sizeof($row);$count++)
                echo "<td>$row[$count]</td>";
        //if($_SESSION['role']=='administrator')
                echo '<td><form action="delete.php" method="post"><input type="checkbox" name="delete[]" value="'.$row[0].'"></td>';
        echo '</tr>';
        $count2++;
}
echo '<tr class="button"><td><input class="delete" type="submit" name="students" value="Delete" colspan=6></td></tr></form>';
echo '</table>';
$clr->footer();
?>