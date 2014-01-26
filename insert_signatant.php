<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('New Signatory','administrator');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('New Signatory', $_SERVER['PHP_SELF'], 1);
$trail->output();
?>

<script language="Javascript">
function validate() /*Validate user inputs*/ {
if(document.getElementById("stid").value.length==0) {
alert("Enter ID number.");
document.getElementById("stid").focus();
return false;
}
if(document.getElementById("lname").value.length==0) {
alert("Enter Last Name.");
document.getElementById("lname").focus();
return false;
}
if(document.getElementById("fname").value.length==0) {
alert("Enter First Name.");
document.getElementById("fname").focus();
return false;
}
if(document.getElementById("mname").value.length==0) {
alert("Enter Middle Name.");
document.getElementById("mname").focus();
return false;
return true;
}
</script>
<p><h1>Insert signatory</h1></p>
<table id="table">
<tr><th>Data Needed</th><th>Input</th></tr>
<form action="insert_signatant.php" method = "post" onsubmit="return validate()">
<tr><td>ID NUMBER:</td><td><input type="text" name="stid" id="stid" size=50></td></tr>
<tr><td>Last Name:</td><td><input type="text" name="lname" id="lname" size=50></td></tr>
<tr><td>First Name:</td><td><input type="text" name="fname" id="fname" size=50></td></tr>
<tr><td>Middle Name:</td><td><input type="text" name="mname" id="mname" size=50></td></tr>
        <tr><td colspan=2 align="center"><input type="submit" name="submit"></td></tr>
        </form>
</table> <?php


//New entry inserted into database
if(isset($_POST['submit']))
{
        $stid= (trim($_POST['stid']) == '')?
        die ('ERROR: Enter ID number') : mysql_escape_string($_POST['stid']);
        $lname= (trim($_POST['lname']) == '')?
        die ('ERROR: Enter Last name') : mysql_escape_string($_POST['lname']);
        $fname= (trim($_POST['fname']) == '')?
        die ('ERROR: Enter First name') : mysql_escape_string($_POST['fname']);
        $mname= (trim($_POST['mname']) == '')?
        die ('ERROR: Enter middle name') : mysql_escape_string($_POST['mname']);
        mysql_connect('localhost','root','');
        mysql_select_db('clearance');
        $query = "INSERT INTO signatory VALUES ($stid,'$lname','$fname','$mname')";
        $result = mysql_query($query) or die ('<script language="Javascript">alert("ID Number already exists");</script>');

        echo '<script type="text/javascript">alert("Success: Inserted new signatory")</script>';
}

$clr->footer();
?>