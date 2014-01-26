<?php
require_once('include/params.php');
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Section','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Section', $_SERVER['PHP_SELF'], 0);
$trail->output();

//Gets the selected section
$sec = isset($_GET['secid'])?$_GET['secid']:$_SESSION['sec'];
$_SESSION['sec'] = $sec;


mysql_connect('localhost','root','');
mysql_select_db('clearance');

//Gets the name of the selected section
$section = mysql_fetch_row(mysql_query("SELECT section FROM sections WHERE secid=$sec"));

//Gets the select non-teaching
$sub = isset($_GET['sub'])?$_GET['sub']:$_SESSION['sub'];
$_SESSION['sub'] = $sub;

//Gets the generated hash code
$hash = isset($_GET['hash'])?$_GET['hash']:$_SESSION['hash'];
$_SESSION['hash'] = $hash;


$array = array("secid"=>$sec,"sub"=>$sub,"hash"=>$hash);

//Parameter Verification
if (!verify_parameters($array)) {
    die("<h1 style='color:red;'>Dweep! Somebody tampered with our parameters</h1>");
}


echo "<p><h1>$section[0]</h1></p>";
?>
<table id="table">
<tr>
<th><b>ID Number</b></th>
<th><b>Last Name</b></th>
<th><b>First Name</b></th>
<th><b>Cleared</b></th>
<th><b>Clear</b></th>
<th><b>Comment</b></th>
</tr><tr>

<?php

//Gets the students involved in the selected non-teaching in the selected section
$result= mysql_query("SELECT students.stid,lname,fname,cleared,st_non_teaching.ot_id FROM students JOIN st_non_teaching USING(stid) WHERE st_non_teaching.ot_id =$sub AND students.stid IN (SELECT stid FROM st_sec WHERE secid= $sec) ORDER BY lname") or die("ERROR:". mysql_error());
$count2=0;

while ($row = mysql_fetch_row($result))
{
        $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
        if($row[3]=="CLEARED") //Checks if student is already cleared
               $tr = "<tr class='clr'>";
        echo $tr;
        echo '<td><a href ="profile.php?stid='.$row[0].'">'.$row[0].'</td>';
        for($count=1;$count<(sizeof($row)-1);$count++)
                echo '<td>' . $row[$count]. '</td>';
        echo '<td><form action="clear.php" method="post"><div id="check'.$count2.'"><input type="checkbox" name="clear[]" value="'.$row[0].'"></div></td>
        <input type="checkbox" name="id[]" value="'.$row[4].'" checked="true" style="display:none;">';
        echo '<td><a href="st_comments.php?subid='.$row[4]."&stid=$row[0]&type=2".'">Comment</a></td>';
if($row[3]=="CLEARED")
            echo '<script language="Javascript">document.getElementById("check'.$count2.'").innerHTML = "";</script>';
        $count2++;
}
echo '<tr class="button"><td></td><td></td><td></td><td></td><td><input class="delete" type="submit" name="non" value="Clear"></td></tr></form></table>';

$clr->footer();
?>