<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Student Record','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Record', $_SERVER['PHP_SELF'], 4);
$trail->output();

//Gets the selected Year Level
$yrlevel = $_GET['yrlevel'];

//Gets the selected ID number of the selected student
$id = $_GET['id'];
$_SESSION['id'] = $id;

        mysql_connect('localhost','root','');
        mysql_select_db('clearance');
        
        //Gets student's basic data
        $name = mysql_fetch_row(mysql_query("SELECT lname,fname FROM students WHERE stid= '$id'"));
        echo "<p><h1>$name[0], $name[1] - $yrlevel</h1></p>";
        
        //Gets The Clearance Record of the Student on the selected Year-level
        $query = "SELECT sub,cleared FROM st_subjects, subjects WHERE stid ='$id' AND st_subjects.sub_id = subjects.sub_id AND st_subjects.yrlevel = $yrlevel";
        $subs=mysql_query($query) or die (mysql_error());
        $count = mysql_fetch_row(mysql_query("SELECT COUNT(sub) FROM st_subjects, subjects WHERE stid ='$id' AND st_subjects.sub_id = subjects.sub_id AND st_subjects.yrlevel = $yrlevel"));
if($count[0]!=0)
{
echo '<table id="table">
                <tr><th>Subject</th><th>Cleared</th></tr>';
$count2=0;
while ($row = mysql_fetch_row($subs))
{
        $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
        echo $tr;
        echo "<td>$row[0]</td>";
        echo "<td>$row[1]</td>";
        echo '</tr>';
        $count2++;
}
echo '</table><br></br>';

echo '<table id="table">
                <tr><th>Non-teaching</th><th>Cleared</th></tr>';
$query = "SELECT des,cleared FROM st_non_teaching, non_teaching WHERE stid ='$id' AND st_non_teaching.ot_id = non_teaching.ot_id AND st_non_teaching.yrlevel = $yrlevel";
$result=mysql_query($query) or die ("Error");
$count2=0;
while ($row = mysql_fetch_row($result))
{
        $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
        echo $tr;
        for($count=0;$count<sizeof($row);$count++)
                echo '<td>' . $row[$count]. '</td>';
        echo '</tr>';
        $count2++;
}
echo '</table><br></br>';

$query = "SELECT club,cleared FROM st_clubs, clubs WHERE stid ='$id' AND st_clubs.clid = clubs.club_id AND st_clubs.yrlevel = $yrlevel";
$result=mysql_query($query) or die ("Error");
$count2=0;
echo '<table id="table">
                <tr><th>Club</th><th>Cleared</th></tr>';
while ($row = mysql_fetch_row($result))
{
        $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
        echo $tr;
        for($count=0;$count<sizeof($row);$count++)
                echo '<td>' . $row[$count]. '</td>';
        echo '</tr>';
        $count2++;
}
echo '</table><br><br>';
}
else
    echo "<p><h1>No Records</h1></p>";
$clr->footer();
?>