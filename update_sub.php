<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Home','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Home', $_SERVER['PHP_SELF'], 0);
$trail->output();
?>
<p><h1>Update Subject</h1></p>
<table id="table">
<tr><th>Data Needed</th><th>Input</th></tr>
<form action="update_sub.php" method = "post" onsubmit="return validate()">
<tr><td>Subject:</td><td><select name="sub">
<?php


mysql_connect('localhost','root','');
mysql_select_db('clearance');

 //Gets the Subjects in the database
$query = "SELECT sub_id,sub FROM subjects ORDER BY sub";
$subjects = mysql_query($query);

//Iterate Extracted Subject into a drop down list
while($row = mysql_fetch_row($subjects))
{
        echo '<option value="'.$row[0].'">'."$row[1]".'</option>';
}

?>
</td></tr>
<tr><td colspan=2 align="center">CHANGE</td></tr>
<tr><td>Year Level:</td><td><select name="yrlevel" id="yrlevel">
<option value="0">--Year Level--</option>
<option value="1">1st Year</option>
<option value="2">2nd Year</option>
<option value="3">3rd Year</option>
<option value="4">4th Year</option>
</select></td></tr>
<tr><td>Teacher:</td><td>
<?php


$connection= mysql_connect('localhost', 'root', '') or die ('Unable to connect!');
mysql_select_db('clearance') or die ('Unable to select database!');

//Gets the signatories in the database
$query = "SELECT stid,lname,fname FROM signatory ORDER BY stid ASC";
$result=mysql_query($query) or die ('Error in query: $query.' . mysql_error());


echo '<select name="teacher"><option value="0">--Teacher--</option>';

//Iterates extracted signatories into a drop down list
while ($row= mysql_fetch_row($result))
{
        echo '<option value="'.$row[0].'">'."$row[1],$row[2]".'</option>';
}
echo '</select></td></tr>';

?>
<tr><td>Is Elective?</td><td><select name="elec">
<option value="false">No</option>
<option value="true">Yes</option>
</select></td></tr>
<tr><td colspan=2 align="center"><input type="submit" name="submit"></td></tr>
</form>
</table>

<?php
if(isset($_POST['submit']))
{

//Inititalize parameters
$sub= mysql_escape_string($_POST['sub']);
$teacher= mysql_escape_string($_POST['teacher']);
$yrlevel= mysql_escape_string($_POST['yrlevel']);
$is_elective = $_POST['elec'];

//Gets the fields of subjects
$fields= mysql_query("DESCRIBE subjects");

//Initialize Query
$query="UPDATE subjects SET";


$check=1;
$check2=0;

 //Checks the empty fields and if not empty add to fields to be updated
while($row = mysql_fetch_row($fields))
{
        $val=$row[0];
        $queryp='';
        $checkt=$check;
        if(($val=='yrlevel')&&($yrlevel!=0))
        {
                $queryp.=" yrlevel = $yrlevel";
                $checkt++;
                $check2++;
        }
        else if(($val=='teacher')&&($teacher!=0))
        {
                $queryp.=" teacher = '$teacher' ";
                $checkt++;
                $check2++;
        }
        else if(($val=='is_elective'))
        {
                $queryp.=" is_elective = $is_elective ";
                $checkt++;
                $check2++;
        }

        if(($checkt!=$check)&&($check2!=1))
                $queryp=" , ".$queryp;
        $query.=$queryp;
}
$query.= " WHERE sub_id ='$sub'";
$result = mysql_query($query ) or die ("<p>Error in query: $query." . mysql_error().'</p>');
echo '<script type="text/javascript">alert("Update Successful")</script>';
}
$clr->footer();
?>