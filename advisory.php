<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Advisory','signatant');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Advisory', $_SERVER['PHP_SELF'], 1);
$trail->output();
$id = $_SESSION['id'];
echo '<p><h1>Advisory Class</h1></p>';
mysql_connect('localhost','root','');
mysql_select_db('clearance');
$records = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM st_sec WHERE secid = (SELECT secid FROM sections WHERE adviser_id = $id)")); //Extracts the section clearance data of the advisory class
$total = $records[0];
if($total != 0) //Check if signatory has advisory class
{
        //Gets the information of students in advisory class
        $students = mysql_query("SELECT stid,lname,fname,cleared,st_sec.secid FROM students INNER JOIN st_sec USING (stid) WHERE st_sec.secid = (SELECT sections.secid FROM sections WHERE adviser_id = $id)");
    
        echo '<table id="table">';
        echo '<tr><th>ID</th><th>Name</th><th>Cleared</th><th>Clear</th><th>Comment</th></tr>';
        $count2=0;
        
        //Iterate the students
        while ($row = mysql_fetch_row($students))
        {
                $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
                echo $tr;
                echo '<td><a href ="profile.php?stid='.$row[0].'">'.$row[0].'</td>';
                echo "<td>$row[1], $row[2]</td><td>$row[3]</td>";
                echo '<td><form action="clear.php" method="post"><input type="checkbox" name="clear[]" value="'.$row[0].'"></td>
                <td><a href="st_comments.php?subid='.$row[4]."&stid=$row[0]&sec=0&type=3".'">Comment</a></td>
                <input type="checkbox" name="id[]" value="'.$row[4].'" checked="true" hidden="true">';
        }
        
        echo '<tr class="button"><td></td><td></td><td></td><td><input class="delete" type="submit" name="sec" value="Clear"></td></tr></form></table>';
        echo "</table>";
}
else
        echo 'You do not have an advisory class'; 
$clr->footer();
?>