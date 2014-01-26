<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Set Clubs', $_SERVER['PHP_SELF'], 1);
$clr = new Clearance('Set Clubs','');
$clr->header();
$trail->output();
?>

<p><h1>Set Clubs</h1></p>
<div class="data">
<form action="set_clubs.php" method="post">
<table id="table"><tr><th>Clubs</th></tr><tr><td align = "center"><select name="club">
<?php
mysql_connect('localhost','root','');
mysql_select_db('clearance');

//Gets the Current Year, the Next Year and the Previous Year respectively
$query = "SELECT DATE_FORMAT(NOW(),'%Y'), DATE_FORMAT(NOW(),'%Y') + 1,DATE_FORMAT(NOW(),'%Y') - 1";
$result = mysql_query($query);
$year1 = mysql_fetch_array($result);

//Gets the Club name and Club id of Clubs
$clubs = mysql_query("SELECT club_id,club FROM clubs");

//Gets the ID number of the selected section
$sec = (isset($_GET['secid']))?$_GET['secid']:$_SESSION['secid'];
$_SESSION['secid'] = $sec;

//Iterate Clubs into a drop down list
while($row = mysql_fetch_row($clubs))
{
        echo '<option value="'.$row[0].'">'."$row[1]</option>";
}

echo "</select></td></tr></table>";

//Gets the students in the selected section
$students = mysql_query("SELECT students.stid,lname,fname FROM students,st_sec WHERE st_sec.stid=students.stid AND st_sec.secid= $sec");

echo '<table id="table">';
echo '<tr><th>Check</th><th>Name</th></tr>';
$count=1;

//Iterates the extracted students
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

//Adds the selected subjects to the selected club for the selected school year
if(isset($_POST['SUBMIT1']))
{
        $club = $_POST['club'];
        $students = (isset($_POST['students']))?$_POST['students']:die('<script type="text/javascript">alert("No Student Selected.");</script>');
        for($x=0;$x < sizeof($students); $x++)
                mysql_query("INSERT INTO st_clubs (clid,stid,year,year2) VALUES ($club,$students[$x],$year1[0],$year1[1])") or die (mysql_error());
        echo '<script language="Javascript">alert("Success");</script>';
}
if(isset($_POST['SUBMIT2']))
{
        $club = $_POST['club'];
        $students = (isset($_POST['students']))?$_POST['students']:die('<script type="text/javascript">alert("No Student Selected.");</script>');
        for($x=0;$x < sizeof($students); $x++)
                mysql_query("INSERT INTO st_clubs (clid,stid,year,year2) VALUES ($club,$students[$x],$year1[2],$year1[0])") or die (mysql_error());
        echo '<script language="Javascript">alert("Success");</script>';
}
$clr->footer();
?>