<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Set Subjects','administrator');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Set Subjects', $_SERVER['PHP_SELF'], 1);
$trail->output();
?>
<p><h1>Set Subjects and Non-teaching</h1><p>
<?php
mysql_connect('localhost','root','');
mysql_select_db('clearance');

//Gets the Current Year, the Next Year and the Previous Year respectively
$query = "SELECT DATE_FORMAT(NOW(),'%Y'), DATE_FORMAT(NOW(),'%Y') + 1,DATE_FORMAT(NOW(),'%Y') - 1";
$result = mysql_query($query);
$year1 = mysql_fetch_array($result);

//Contains value for checking if an option was selected
$adv = isset($_GET['adv'])?$_GET['adv']:3;


echo '<div class="select"><a href="set_subs.php?adv=1&yr1='.$year1[0].'&yr2='.$year1[1].'">Set Subjects and Non-teaching for '. "SY $year1[0] - $year1[1]" .'</a><br>
    <a href="set_subs.php?adv=1&yr1='.$year1[2].'&yr2='.$year1[0].'">Set Subjects and Non-teaching for '. "SY $year1[2] - $year1[0]" .'</a></div>';

//Gets the ID number and year level of all studnents in the database
$st = mysql_query("SELECT stid,yrlevel FROM students");

//Checks if an option was already selected
if($adv == 1)
{
        $yr1 = $_GET['yr1'];
        $yr2 = $_GET['yr2'];
        while($row = mysql_fetch_row($st))
        {
                $subs = mysql_query("SELECT sub_id FROM subjects WHERE yrlevel = $row[1] AND is_elective = 0");
                while($row2 = mysql_fetch_row($subs))
                {
                        mysql_query("INSERT INTO st_subjects (stid,sub_id,year,year2) VALUES ($row[0],$row2[0],$yr1,$yr2)");
                }
                $non = mysql_query("SELECT ot_id FROM non_teaching");
                while($row2 = mysql_fetch_row($non))
                {
                        mysql_query("INSERT INTO st_non_teaching (stid,ot_id,year,year2) VALUES ($row[0],$row2[0],$yr1,$yr2)");
                }
        }
        echo '<script type="text/javascript">alert("Set Successful");</script>';
}
$clr->footer();
?>