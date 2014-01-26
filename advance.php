<?php

include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Year Level','administrator');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Year Level', $_SERVER['PHP_SELF'], 1);
$trail->output();

?>
<p><h1>Advance Year Level</h1></p>
<?php
mysql_connect('localhost','root','');
mysql_select_db('clearance');

$adv = isset($_GET['adv'])?$_GET['adv']:3; //Check if an option was already selected


//Options
echo '<div class="select"><a href="advance.php?adv=1">Advance Student Year Level</a><br>
        <a href="advance.php?adv=0">Revert Student Year Level</a><br/>
        <a href="advance.php?adv=2">Confirm Alumni</a></div>';


$yrlevel = mysql_query("SELECT DISTINCT yrlevel FROM students");

//Get current year
$date = getdate();
$year = $date['year'];

if($adv == 1) //Advances Students to next Year level, if student is in 4th year then Year Level becomes the current year which is assumed to be their batch
{
        while($row = mysql_fetch_row($yrlevel))
        {
                $advnc = $row[0] + 1;
                if($row[0] < 4)
                mysql_query("UPDATE students SET yrlevel = $advnc WHERE yrlevel=$row[0]");
                else if ($row[0] == 4)
                mysql_query("UPDATE students SET yrlevel = '$year' WHERE yrlevel=$row[0]");
        }
        echo '<script type="text/javascript">alert("Advance Successful");</script>';
}

else if($adv == 0) //Reverts Students to previous Year Level
{
        while($row = mysql_fetch_row($yrlevel))
        {
                $advnc = $row[0] - 1;
                if($row[0] <= 4)
                        mysql_query("UPDATE students SET yrlevel = $advnc WHERE yrlevel=$row[0]");
                else if($row[0] == $year)
                        mysql_query("UPDATE students SET yrlevel = 4 WHERE yrlevel=$row[0] AND NOT(is_alumni)");
        }
        echo '<script type="text/javascript">alert("Revert Successful");</script>';
}

else if($adv== 2) //Students with year level equal to the current year are now confirmed alumni. WARNING: This is irreversible
{
      mysql_query("UPDATE students SET is_alumni=1 WHERE yrlevel=$year");
      echo '<script type="text/javascript">alert("Alumni Confirmed");</script>';
}
$clr->footer();
?>