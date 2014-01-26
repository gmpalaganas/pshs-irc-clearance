<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Home','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Home', $_SERVER['PHP_SELF'], 0);
$trail->output();
?>
<p><h1>Update Signatory</h1></p>
<div class="select">
<table id="table">
<tr><th>Data Needed</th><th>Input</th></tr>
<form action="update_sig.php" method="post">
<tr><td>Signatory:</td><td><select name="stid">
<?php
    mysql_connect('localhost','root','');
    mysql_select_db('clearance');
    
    //Gets the signatories in the database
    $query = "SELECT stid,lname,fname FROM signatory ORDER BY lname";
    $students = mysql_query($query);
    
    //Iterates extracted signatories into a drop down list
    while($row = mysql_fetch_row($students))
    {
            echo '<option value="'.$row[0].'">'."$row[1], $row[2]".'</option>';
    }
?>
<tr><td colspan=2 align="center">CHANGE</td></tr>
<tr><td>ID NUMBER:</td><td><input type="text" name="stid2" size=50></td></tr>
<tr><td>First name:</td><td><input type="text" name="fname" size=50></td></tr>
<tr><td>Last name:</td><td><input type="text" name="lname" size=50></td></tr>
<tr><td>Middle Name:</td><td><input type="text" name="minit" size=50></td></tr>
    <tr><td colspan=2 align="center"><input type="submit" name="submit"></td></tr>
</form>
</table>
</div>
<?php
if(isset($_POST['submit']))
{
    //Inititalize parameters
    $stid= (trim($_POST['stid']) == '')?
    die ('ERROR: Enter ID number') : mysql_escape_string($_POST['stid']);
    $stid2= (trim($_POST['stid2']) == '')?
    ' ' : mysql_escape_string($_POST['stid2']);
    $lname= (trim($_POST['lname']) == '')?
    ' ' : mysql_escape_string($_POST['lname']);
    $fname= (trim($_POST['fname']) == '')?
    ' ' : mysql_escape_string($_POST['fname']);
    $minit= (trim($_POST['minit']) == '')?
    ' ' : mysql_escape_string($_POST['minit']);
    
    //Gets the fields of signatory
    $fields= mysql_query("DESCRIBE signatory");
    
    //Initialize Query
    $query="UPDATE signatory SET";
    
    
    $check=1;
    $check2=0;
    
    //Checks the empty fields and if not empty add to fields to be updated
    while($row = mysql_fetch_row($fields))
    {
            $val=$row[0];
            $queryp='';
            $checkt=$check;
            if(($val=='lname')&&($lname!=' '))
            {
                    $queryp.=" lname = '$lname'";
                    $checkt++;
                    $check2++;
            }
            else if(($val=='fname')&&($fname!=' '))
            {
                    $queryp.=" fname = '$fname' ";
                    $checkt++;
                    $check2++;
            }
            else if(($val=='mname')&&($minit!=' '))
            {
                    $queryp.=" mname = '$minit' ";
                    $checkt++;
                    $check2++;
            }
            else if(($val=='stid')&&($stid2!=' '))
            {
                    $queryp.=" stid =$stid2 ";
                    $checkt++;
                    $check2++;
            }
            if(($checkt!=$check)&&($check2!=1))
                    $queryp=" , ".$queryp;
            $query.=$queryp;
    }
    $query.= " WHERE stid ='$stid'";
    $result = mysql_query($query ) or die ("<p>Error in query: $query." . mysql_error().'</p>');
    echo '<script type="text/javascript">alert("Update Successful")</script>';
}
$clr->footer();
?>