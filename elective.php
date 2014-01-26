<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Set Elective','administrator');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Set Elective', $_SERVER['PHP_SELF'], 2);
$trail->output();
?>
<p><h1>Set Elective</h1></p>
<div class="data">
<form action="elective.php" method="post">
<table id="table"><tr><th>Elective</th></tr><tr><td align = "center"><select name="subject">
<?php
mysql_connect('localhost','root','');
mysql_select_db('clearance');

//Gets the Current Year, the Next Year and the Previous Year respectively
$query = "SELECT DATE_FORMAT(NOW(),'%Y'), DATE_FORMAT(NOW(),'%Y') + 1,DATE_FORMAT(NOW(),'%Y') - 1";
$result = mysql_query($query);
$year1 = mysql_fetch_array($result);

//Gets the subjects which are electives
$subjects = mysql_query("SELECT sub_id,sub FROM subjects WHERE is_elective");

//Gets the ID of the Selected Section
$sec = (isset($_GET['secid']))?$_GET['secid']:$_SESSION['secid'];
$_SESSION['secid'] = $sec;

//Puts the electives in a drop down list
while($row = mysql_fetch_row($subjects))
{
        echo '<option value="'.$row[0].'">'."$row[1]</option>";
}
echo "</select></td></tr></table>";

//Gets the students in the selected section
$students = mysql_query("SELECT students.stid,lname,fname FROM students,st_sec WHERE st_sec.stid=students.stid AND st_sec.secid= $sec");


echo '<table id="table">';
echo '<tr><th>Check</th><th>Name</th></tr>';
$count=1;
while ($row = mysql_fetch_row($students))
{
        echo '<tr><td><input type="checkbox" name="students[]" value = "'.$row[0].'"></td>'."<td>$row[1],$row[2]</td></tr>";
}
echo "</table>";
echo "<input type='submit' name='SUBMIT1' value='Set for $year1[0] - $year1[1]'>";
echo "<input type='submit' name='SUBMIT2' value='Set for $year1[2] - $year1[0]'>";
?>
</form>
</div>
<?php

//New Entries are inserted

if(isset($_POST['SUBMIT1']))
{
        $elective = $_POST['subject'];
        $students = (isset($_POST['students']))?$_POST['students']:die('<script type="text/javascript">alert("No Student Selected.");</script>');
        for($x=0;$x < sizeof($students); $x++)
            mysql_query("INSERT INTO st_subjects (sub_id,stid,year,year2) VALUES ($elective,$students[$x],$year1[0],$year1[1])") or die (mysql_error());
        echo '<script language="Javascript">alert("Success");</script>';
}

if(isset($_POST['SUBMIT2']))
{
        $elective = $_POST['subject'];
        $students = (isset($_POST['students']))?$_POST['students']:die('<script type="text/javascript">alert("No Student Selected.");</script>');
        for($x=0;$x < sizeof($students); $x++)
            mysql_query("INSERT INTO st_subjects (sub_id,stid,year,year2) VALUES ($elective,$students[$x],$year1[2],$year1[0])") or die (mysql_error());
        echo '<script language="Javascript">alert("Success");</script>';
}

$clr->footer();
?>