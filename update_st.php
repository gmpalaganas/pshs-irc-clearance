<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Home','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Home', $_SERVER['PHP_SELF'], 0);
$trail->output();
?>
<script type='text/javascript'>
 function validate() /*Validate user inputs*/ {
	if((document.getElementById("1").value==0)&&(document.getElementById("2").value==0)&&(document.getElementById("3").value==0)&&(document.getElementById("4").value==0)) {
		alert("Select Student.");
		document.getElementById("username").focus();
		return false;
	}
	return true;
}
function hide1()
{

document.getElementById('2').value = 0
document.getElementById('3').value = 0
document.getElementById('4').value = 0

document.getElementById('1').disabled = false;
document.getElementById('1').hidden = false;

document.getElementById('2').disabled = true;
document.getElementById('2').hidden = true;

document.getElementById('3').disabled = true;
document.getElementById('3').hidden = true;

document.getElementById('4').disabled = true;
document.getElementById('4').hidden = true;
}

function hide2()
{

document.getElementById('1').value = 0
document.getElementById('3').value = 0
document.getElementById('4').value = 0

document.getElementById('1').disabled = true;
document.getElementById('1').hidden = true;

document.getElementById('2').disabled = false;
document.getElementById('2').hidden = false;

document.getElementById('3').disabled = true;
document.getElementById('3').hidden = true;

document.getElementById('4').disabled = true;
document.getElementById('4').hidden = true;
}

function hide3()
{
document.getElementById('1').value = 0
document.getElementById('2').value = 0
document.getElementById('4').value = 0

document.getElementById('1').disabled = true;
document.getElementById('1').hidden = true;

document.getElementById('2').disabled = true;
document.getElementById('2').hidden = true;

document.getElementById('3').disabled = false;
document.getElementById('3').hidden = false;

document.getElementById('4').disabled = true;
document.getElementById('4').hidden = true;
}

function hide4()
{
 
document.getElementById('1').value = 0
document.getElementById('2').value = 0
document.getElementById('3').value = 0

document.getElementById('1').disabled = true;
document.getElementById('1').hidden = true;

document.getElementById('2').disabled = true;
document.getElementById('2').hidden = true;

document.getElementById('3').disabled = true;
document.getElementById('3').hidden = true;

document.getElementById('4').disabled = false;
document.getElementById('4').hidden = false;
}


</script>
<p><h1>Update Student</h1></p>
<div class="select">
<table id="table">
<tr><th>Data Needed</th><th>Input</th></tr>
<form action="update_st.php" method="post" onsubmit='return validate();'>
<tr>
<td>Student:</td><td>
<select name="stid" id="1">
            <option value="0">--First Year--</option>
<?php
    

    mysql_connect('localhost','root','');
    mysql_select_db('clearance');
   
    //Gets the 1st year students in the database
    $query = "SELECT stid,lname,fname FROM students WHERE yrlevel=1 ORDER BY lname";
    $students = mysql_query($query);
    
    //Iterates extracted 1st year students into a drop down list
    while($row = mysql_fetch_row($students))
    {
            echo '<option value="'.$row[0].'">'."$row[1], $row[2]".'</option>';
    }
?>
        </select>
    <select name="stid" id="2" hidden disabled>
        <option value="0">--Second Year--</option>
<?php
    mysql_connect('localhost','root','');
    mysql_select_db('clearance');
    
    //Gets the 2nd year students in the database
    $query = "SELECT stid,lname,fname FROM students WHERE yrlevel=2 ORDER BY lname";
    $students = mysql_query($query);
    
     //Iterates extracted 2nd year students into a drop down list
    while($row = mysql_fetch_row($students))
    {
            echo '<option value="'.$row[0].'">'."$row[1], $row[2]".'</option>';
    }
?>
        </select>
    <select name="stid" id="3" hidden disabled>
        <option value="0">--Third Year--</option>
<?php
    

    mysql_connect('localhost','root','');
    mysql_select_db('clearance');
   
    //Gets the 3rd year students in the database
    $query = "SELECT stid,lname,fname FROM students WHERE yrlevel=3 ORDER BY lname";
    $students = mysql_query($query);
    
     //Iterates extracted 3rd year students into a drop down list
    while($row = mysql_fetch_row($students))
    {
            echo '<option value="'.$row[0].'">'."$row[1], $row[2]".'</option>';
    }
?>
        </select>
<select name="stid" id="4" hidden disabled>
    <option value="0">--Fourth Year--</option>
<?php


    mysql_connect('localhost','root','');
    mysql_select_db('clearance');
   
    //Gets the 4th year students in the database
    $query = "SELECT stid,lname,fname FROM students WHERE yrlevel=4 ORDER BY lname";
    $students = mysql_query($query);
    
     //Iterates extracted 4th year students into a drop down list
    while($row = mysql_fetch_row($students))
    {
            echo '<option value="'.$row[0].'">'."$row[1], $row[2]".'</option>';
    }
?>
        </select>
</td></tr>
<tr><td>Year level</td><td>
<input type='radio' onclick='hide1();' name="yr" checked/>First Year
<input type='radio' onclick='hide2();' name="yr"/>Second Year   
<input type='radio' onclick='hide3();' name="yr"/>Third Year   
<input type='radio' onclick='hide4();' name="yr"/>Fourth Year   
</td></tr>
<tr><td colspan=2 align="center">CHANGE</td></tr>
<tr><td>ID NUMBER:</td><td><input type="text" name="stid2" size=50></td></tr>
<tr><td>First name:</td><td><input type="text" name="fname" size=50></td></tr>
<tr><td>Last name:</td><td><input type="text" name="lname" size=50></td></tr>
<tr><td>Middle Name:</td><td><input type="text" name="minit" size=50></td></tr>
<tr><td>Address:</td><td><input type="text" name="add" size=50></td></tr>
<tr><td>Contact Number:</td><td><input type="text" name="contact" size=50></td></tr>
<tr><td>Year Level:</td><td><select name="yr_lvl">
    <option value="0">--Year Level--</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    </select></td></tr>
<tr><td>Section:</td><td><select name="sec">
    <option value="0">--Section--</option>
    <?php
            //Gets all the sections in the database
            $section = mysql_query("SELECT secid,section FROM sections");
            
            //Iterate extracted sections into a drop down list
            while ($row= mysql_fetch_row($section))
            {
                    echo '<option value="'.$row[0].'">' . $row[1]. '</option>';
            }
    ?>
    </select></td></tr>
<tr><td>School Year: (For Section)</td><td>
        <?php
        //Gets the Current Year, the Next Year and the Previous Year respectively
        $query = "SELECT DATE_FORMAT(NOW(),'%Y'), DATE_FORMAT(NOW(),'%Y') + 1,DATE_FORMAT(NOW(),'%Y') - 1";
        $result = mysql_query($query);
        $year1 = mysql_fetch_array($result);
        
        
        echo "<select name='year1'>";
        echo "<option value='$year1[2]'>$year1[2]</option>";
        echo "<option value='$year1[0]'>$year1[0]</option>";
        echo "</select>";
        
        echo "-";
        
        echo "<select name='year2'>";
        echo "<option value='$year1[0]'>$year1[0]</option>";
        echo "<option value='$year1[1]'>$year1[1]</option>";
        echo "</select>";
    ?>
    </td></tr>
    <tr><td colspan=2 align="center"><input type="submit" value='Submit' name="submit"></td></tr>
</form>
</table>
</div>
<?php
if(isset($_POST['submit']))
{
    
    //Inititalize parameters
    $stid= (trim($_POST['stid']) == '0')?
    die : mysql_escape_string($_POST['stid']);
    $stid2= (trim($_POST['stid2']) == '')?
    ' ' : mysql_escape_string($_POST['stid2']);
    $lname= (trim($_POST['lname']) == '')?
    ' ' : mysql_escape_string($_POST['lname']);
    $fname= (trim($_POST['fname']) == '')?
    ' ' : mysql_escape_string($_POST['fname']);
    $minit= (trim($_POST['minit']) == '')?
    ' ' : mysql_escape_string($_POST['minit']);
    $add= (trim($_POST['add']) == '')?
    ' ' : mysql_escape_string($_POST['add']);
    $contact= (trim($_POST['contact']) == '')?
    ' ' : mysql_escape_string($_POST['contact']);
    $yr_lvl=(trim($_POST['yr_lvl']) == '0')?
    '0' : mysql_escape_string($_POST['yr_lvl']);
    $sec=(trim($_POST['sec']) == '0')?
    ' ' : mysql_escape_string($_POST['sec']);
    $yr1 = $_POST['year1'];
    $yr2 = $_POST['year2'];
    
    //Gets the fields of students
    $fields= mysql_query("DESCRIBE students");
    
    //Initialize Query
    $query="UPDATE students SET";
    
    
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
            else if(($val=='yrlevel')&&($yr_lvl!='0'))
            {
                    $queryp.=" yrlevel = $yr_level";
                    $checkt++;
                    $check2++;
            }
            else if(($val=='stid')&&($stid2!=' '))
            {
                    $queryp.=" stid =$stid2 ";
                    $checkt++;
                    $check2++;
            }
            else if(($val=='address')&&($add!=' '))
            {
                    $queryp.=" address ='$add' ";
                    $checkt++;
                    $check2++;
            }
            else if(($val=='cont_num')&&($contact!=' '))
            {
                    $queryp.=" cont_num = '$contact' ";
                    $checkt++;
                    $check2++;
            }
            if(($checkt!=$check)&&($check2!=1))
                    $queryp=" , ".$queryp;
            $query.=$queryp;
    }
            if(($val=='secid')&&($sec!=' '))
            {
                    $query4="UPADTE st_sec SET secid = $sec WHERE stid = $stid AND year = '$yr1' AND year2 = '$yr2'";                    
                    mysq_query("$query4");
                    
            }
    $query.= " WHERE stid ='$stid'";
    $result = mysql_query($query ) or die ("<p>Error in query: $query." . mysql_error().'</p>');
    echo '<script type="text/javascript">alert("Update Successful")</script>';
}
$clr->footer();
?>