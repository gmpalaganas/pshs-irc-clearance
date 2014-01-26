<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('New Non-teaching','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('New Non-teaching', $_SERVER['PHP_SELF'], 1);
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
<p><h1>Insert New Non-Teaching</h1></p>
<table id="table">
<tr><th>Data Needed</th><th>Input</th></tr>
<form action="input_non.php" method = "post" onsubmit="return validate()">
<tr><td>Description:</td><td><input type="text" name="sub" id="sub" size=50></td></tr>
<tr><td>Assigned:</td><td>
<?php
$connection= mysql_connect('localhost', 'root', '') or die ('Unable to connect!');
mysql_select_db('clearance') or die ('Unable to select database!');

//Gets the names of signatories
$query = "SELECT stid,lname,fname FROM signatory ORDER BY stid ASC";
$result=mysql_query($query) or die ('Error in query: $query.' . mysql_error());


echo '<select name="teacher"><option value="0">--Assigned--</option>';
while ($row= mysql_fetch_row($result))
{
                echo '<option value="'.$row[0].'">'."$row[1],$row[2]".'</option>';
}
echo '</select></td></tr>';

?>
        <tr><td colspan=2 align="center"><input type="submit" name="submit"></td></tr>
        </form>
</table>

<?php

//New entry inserted into database
if(isset($_POST['submit']))
{
        $sub= (trim($_POST['sub']) == '')?
        die ('ERROR: Enter Non-teaching') : mysql_escape_string($_POST['sub']);
        $teacher= ($_POST['teacher'] == 0)?
        die ('ERROR: Select Teacher') : mysql_escape_string($_POST['teacher']);
        $query = "INSERT INTO non_teaching (des,signatant) VALUES ('$sub','$teacher')";
        $result = mysql_query($query) or die ('Error in query: $query.' . mysql_error(). "<br>$query");
        echo '<script type="text/javascript">alert("Success: Inserted New Non-teaching")</script>';
}
$clr->footer();
?>