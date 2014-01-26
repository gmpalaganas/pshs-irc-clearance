<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('New Subject','administrator');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('New Subject', $_SERVER['PHP_SELF'], 1);
$trail->output();
?>

<script language="Javascript">
function validate() /*Validate user inputs*/ {
if(document.getElementById("sub").value.length==0) {
    alert("Enter Subject.");
    document.getElementById("sub").focus();
return false;
}

return true;
}
</script>

<p><h1>Insert New Subject</h1></p>
<table id="table">
<tr><th>Data Needed</th><th>Input</th></tr>
<form action="input_sub.php" method = "post" onsubmit="return validate()">
<tr><td>Subject:</td><td><input type="text" name="sub" id="sub" size=50></td></tr>
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

//Gets the names of signatories
$query = "SELECT stid,lname,fname FROM signatory ORDER BY stid ASC";
$result=mysql_query($query) or die ('Error in query: $query.' . mysql_error());


echo '<select name="teacher"><option value="0">--Teacher--</option>';
while ($row= mysql_fetch_row($result))
{
                echo '<option value="'.$row[0].'">'."$row[1],$row[2]".'</option>';
}
echo '</select></td></tr>';

?>
        <tr><td>Is Elective?</td><td><select name="elec"><option value="false">No</option>
        <option value="true">Yes</option></select></td></tr>
        <tr><td colspan=2 align="center"><input type="submit" name="submit"></td></tr>
        </form>
</table>

<?php

//New entry inserted into database
if(isset($_POST['submit']))
{
        $sub= (trim($_POST['sub']) == '')?
        die ('ERROR: Enter subject') : mysql_escape_string($_POST['sub']);
        $teacher= ($_POST['teacher'] == 0)?
        die ('ERROR: Select Teacher') : mysql_escape_string($_POST['teacher']);
        $yrlevel= ($_POST['yrlevel'] == '0')?
        die ('ERROR: Enter Section') : mysql_escape_string($_POST['yrlevel']);
        $is_elective = $_POST['elec'];
        $query = "INSERT INTO subjects (sub,teacher,yrlevel,is_elective) VALUES ('$sub','$teacher',$yrlevel,$is_elective)";
        $result = mysql_query($query) or die ('Error in query: $query.' . mysql_error(). "<br>$query");
        echo '<script type="text/javascript">alert("Success: Inserted New Subject")</script>';
}
$clr->footer();
?>