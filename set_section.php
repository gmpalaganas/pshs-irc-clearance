<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Set Section','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Set Section', $_SERVER['PHP_SELF'], 1);
$trail->output();

//Gets the selected year level
$yrlevel = (isset($_GET['yrlevel']))?$_GET['yrlevel']:$_SESSION['yr'];
$_SESSION['yr'] = $yrlevel;


mysql_connect('localhost','root','');
mysql_select_db('clearance');

//Gets the students in the selected year level
$query = "SELECT students.stid,lname,fname,students.yrlevel FROM students WHERE yrlevel = $yrlevel ORDER BY stid ASC";
$students = mysql_query($query);

//Gets the all sections in the database
$query2 = "SELECT secid,section FROM sections";
$sections= mysql_query($query2);

//Gets the Current Year, the Next Year and the Previous Year respectively
$query = "SELECT DATE_FORMAT(NOW(),'%Y'), DATE_FORMAT(NOW(),'%Y') + 1,DATE_FORMAT(NOW(),'%Y') - 1";
$result = mysql_query($query);
$year1 = mysql_fetch_array($result);

?>
<p><h1>Set Section</h1></p>
<form action="set_section.php" method="post">
<table id="table"><tr><th>Section</th></tr><tr><td align = "center">
<select name="section">
<?php

//Iterate the extracted sections into a drop down list
while($row = mysql_fetch_row($sections))
{
    echo '<option value="'.$row[0].'">'."$row[1]</option>";
}

echo '</select></td></tr></table>';
echo '<table id="table">
<tr><th>Check</th><th>Student</th><th>Year Level</th>';

//Iterate the extracted students
while ($row = mysql_fetch_row($students))
{
    echo '<tr><td><input type="checkbox" name="students[]" value = "'.$row[0].'"></td>'."<td>$row[1],$row[2]</td><td>$row[3]</td></tr>";
}
echo "</table>";
    
echo "<input type='submit' name='SUBMIT1' value='Set for $year1[0]-$year1[1]'/><input type='submit' name='SUBMIT2' value='Set for $year1[2]-$year1[0]'/></form>";

//Adds the selected students into the selected section with selected school year
if(isset($_POST['SUBMIT1']))
{
    $students = (isset($_POST['students']))?$_POST['students']:die('<script type="text/javascript">alert("No Student Selected.");</script>');
    $section = $_POST['section'];
    for($x=0;$x < sizeof($students); $x++)
    {
            mysql_query("INSERT INTO st_sec (secid,stid,year,year2) VALUE ($section,$students[$x],$year1[0],$year1[1])");
    }
    echo '<script type="text/javascript">alert("Successful");</script>';
}
if(isset($_POST['SUBMIT2']))
{
    $students = (isset($_POST['students']))?$_POST['students']:die('<script type="text/javascript">alert("No Student Selected.");</script>');
    $section = $_POST['section'];
    for($x=0;$x < sizeof($students); $x++)
    {
            mysql_query("INSERT INTO st_sec (secid,stid,year,year2) VALUE ($section,$students[$x],$year1[2],$year1[0])");
    }
    echo '<script type="text/javascript">alert("Successful");</script>';
}

$clr->footer();
?>