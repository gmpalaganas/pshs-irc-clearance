<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Sections','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Sections', $_SERVER['PHP_SELF'], 1);
$trail->output();
?>

<p><h1>Clubs</h1></p>

<?php

$id = $_SESSION['id']; //Gets the ID number of the current user


mysql_connect('localhost','root','');
mysql_select_db('clearance');

//Gets the clubs handled by the user
$query="SELECT club_id,club FROM clubs WHERE adviser = '$id'";
$subjects = mysql_query($query);

//Checks if user handles any club
if (mysql_num_rows($subjects)==0)
echo "<p>You do not handle any Club</p>";

while ($sub = mysql_fetch_row($subjects))
{
    
//Gets the sections of the students who are members of the club handled by the user    
$query  = "SELECT secid,section FROM sections WHERE secid IN (SELECT secid FROM st_sec WHERE stid IN (SELECT stid FROM st_clubs WHERE st_clubs.clid = $sub[0]))";
$sections = mysql_query($query);

//Counts the sections
$records = mysql_fetch_row(mysql_query("SELECT COUNT(secid) FROM sections WHERE secid IN (SELECT secid FROM students WHERE stid IN (SELECT stid FROM st_subjects WHERE sub_id = $sub[0]))"));
$count2=0;
$total = $records[0];


if($total!=0)
{
        echo "<p><h2>$sub[1]</h2></p>";
        echo '<table id = "table">';
        echo '<tr><th>Section</th></tr>';
        while ($row = mysql_fetch_row($sections))
        {
                $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
                echo $tr;
                $array = array("secid"=>$row[0],"sub"=>$sub[0]);
                echo "<td><a href ='sig_sec_clubs.php?".create_parameters($array).">$row[1]</td></tr>";
                $count2++;
        }
        echo '</table>';
}
}

$clr->footer();
?>