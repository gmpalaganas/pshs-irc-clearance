<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Student Profile','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();

$alumni = (isset($_SESSION['alumni']))?$_SESSION['alumni']:0; //Gets wheter students is alumni or not

$connect=mysql_connect('localhost','root','') or die ('Unable to connect');
mysql_select_db('clearance') or die ('Unable to select');


$stid=(!isset($_GET['stid'])? $_SESSION['id']:$_GET['stid']); //Gets the Student ID of selected students

$username= $_SESSION['username'];

if(!isset($_GET['alumni'])) //if not alumni
{
$trail->add('Students Profile', $_SERVER['PHP_SELF'], 3);
$_SESSION['alumni']=0;

$trail->output(); echo "<div id='today' class='time'></div>";;

//Gets Student information
$query= "SELECT students.*,section FROM students,sections,st_sec WHERE students.stid='$stid' AND  students.stid = st_sec.stid AND st_sec.secid = sections.secid";
$result=mysql_query($query) or die ('Error in query: $query.' . mysql_error());
$row = mysql_fetch_row($result);
echo '<table id="table">';
echo '<tr><th colspan=2 style="text-align:center;">Student Profile</th></tr>';
echo '<h1>Profile</h1></p><div class="info">'."<tr><td>Student ID:</td> <td>$row[0]</td></tr>
<tr><td>Name:</td> <td>$row[1], $row[2] $row[3]</td></tr>
<tr><td>Year and Section:</td><td>$row[4]-$row[8]</td></tr>
<tr><td>Contact Number:</td><td> $row[5]</td></tr>
<tr><td>Address:</td> <td>$row[6]</td></tr>";
echo '</table><br>';
}

else //if alumni
{
$_SESSION['alumni']=1;
$trail->add('Student Profile', "profile.php?id=$stid&alumni=$alumni", 3);
$trail->output(); echo "<div id='today' class='time'></div>";;

//Gets Alumni information
$query= "SELECT stid, lname, fname, mname, cont_num,address FROM students WHERE stid='$stid'";
$result=mysql_query($query) or die ('Error in query: $query.' . mysql_error());
$row = mysql_fetch_row($result);
echo '<table id="table">';
echo '<tr><th colspan=2 style="text-align:center;">Alumni Profile</th></tr>';
echo '<h1>Profile</h1></p><div class="info">'."<tr><td>Student ID:</td> <td>$row[0]</td></tr>
<tr><td>Name:</td> <td>$row[1], $row[2] $row[3]</td></tr>
<tr><td>Contact Number:</td><td> $row[4]</td></tr>
<tr><td>Address:</td> <td>$row[5]</td></tr>";
echo '</table><br>';
}
echo '<a href="record.php?yrlevel=1&id='.$row[0].'">See 1st Year Clearance</a><br>
        <a href="record.php?yrlevel=2&id='.$row[0].'">See 2nd Year Clearance</a><br>
        <a href="record.php?yrlevel=3&id='.$row[0].'">See 3rd Year Clearance</a><br>
        <a href="record.php?yrlevel=4&id='.$row[0].'">See 4th Year Clearance</a><br>';
echo '</div>';
$clr->footer();
?>