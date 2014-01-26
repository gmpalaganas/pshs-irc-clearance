<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('New Student','administrator');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('New Student', $_SERVER['PHP_SELF'], 1);
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
}
if(document.getElementById("address").value.length==0) {
alert("Enter address.");
document.getElementById("address").focus();
return false;
}
if(document.getElementById("contact").value.length==0) {
alert("Enter Contact Number.");
document.getElementById("contact").focus();
return false;
}
if(document.getElementById("section").value==0) {
alert("Select Section.");
document.getElementById("section").focus();
return false;
}
if(document.getElementById("yrlevel").value==0) {
alert("Select Year Level.");
document.getElementById("yrlevel").focus();
return false;
}
return true;
}
</script>

<p><h1>Insert New Student</h1></p>
<table id="table">
<tr><th>Data needed</th><th>Input</th></tr>
<form action="insert_student.php" method = "post" onsubmit="return validate()">
<tr><td>ID NUMBER:</td><td><input type="text" name="stid" id="stid" size=50></td></tr>
<tr><td>Last Name:</td><td><input type="text" name="lname" id="lname" size=50></td></tr>
<tr><td>First Name:</td><td><input type="text" name="fname" id="fname" size=50></td></tr>
<tr><td>Middle Name:</td><td><input type="text" name="mname" id="mname" size=50></td></tr>

<tr><td>Address:</td><td><input type="text" name="address" id="address" size=50></td></tr>
<tr><td>Contact Number:</td><td><input type="text" name="cont_num" id="contact" size=50></td></tr>

<tr><td>Year Level:</td><td><select name="yrlevel" id="yrlevel">
    <option value="0">--Year Level--</option>
    <option value="1">1st Year</option>
    <option value="2">2nd Year</option>
    <option value="3">3rd Year</option>
    <option value="4">4th Year</option>
    </select></td></tr>

<tr><td>Section:</td><td><select name="secid" id="section">
    <option value="0">--Sections--</option>
    <?php
    mysql_connect('localhost','root','');
    mysql_select_db('clearance');
            $query= "SELECT secid,section FROM sections";
            $data = mysql_query($query) or die ('Error in query: $query.' . mysql_error());
    while ($row= mysql_fetch_row($data))
    {
            echo '<option value="'.$row[0].'">'.$row[1].'</option>';
    }
    ?>
    </select></td></tr>
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
    $address= (trim($_POST['address']) == '')?
    die ('ERROR: Enter Address') : mysql_escape_string($_POST['address']);
    $cont_num= (trim($_POST['cont_num']) == '')?
    die ('ERROR: Enter Contact Number') : mysql_escape_string($_POST['cont_num']);
    $yrlevel= ($_POST['yrlevel'] == '0')?
    die ('ERROR: Enter Section') : mysql_escape_string($_POST['yrlevel']);
    $secid=($_POST['secid']=="0")?
    die ('ERROR: Select Section') : mysql_escape_string($_POST['secid']);


    $query = "INSERT INTO students (stid,lname,fname,mname,yrlevel,cont_num,address) VALUES ($stid,'$lname','$fname','$mname',$yrlevel,'$cont_num','$address')";
    $result = mysql_query($query) or die ('<script language="Javascript">alert("ID Number already exists");</script>' );
    mysql_query("INSERT INTO st_sec (stid,secid,yrlevel) VALUES ($stid,$secid,$yrlevel)");

    echo '<script type="text/javascript">alert("Success: Inserted New Student")</script>';
}
$clr->footer();
?>