<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Home','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Home', $_SERVER['PHP_SELF'], 0);
$trail->output();
?>
<p><h1>Update Section</h1></p>
<table id="table">
<tr><th>Data Needed</th><th>Input</th></tr>
<form action="update_non.php" method = "post" onsubmit="return validate()">
<tr><td>Section:</td><td><select name="sub">
<?php


    mysql_connect('localhost','root','');
    mysql_select_db('clearance');

    //Gets the Sections in the database
    $query = "SELECT secid,section FROM sections ORDER BY section";
    $subjects = mysql_query($query) or die("ERROR:".mysql_error());
    
     //Iterate Extracted Sections into a drop down list
    while($row = mysql_fetch_row($subjects))
    {
            echo '<option value="'.$row[0].'">'."$row[1]".'</option>';
    }
?>
</td></tr>
<tr><td colspan=2 align="center">CHANGE</td></tr>
<tr><td>Adviser:</td><td>
<?php


$connection= mysql_connect('localhost', 'root', '') or die ('Unable to connect!');
mysql_select_db('clearance') or die ('Unable to select database!');

//Gets the signatories in the database
$query = "SELECT stid,lname,fname FROM signatory ORDER BY stid ASC";
$result=mysql_query($query) or die ('Error in query: $query.' . mysql_error());


echo '<select name="teacher"><option value="0">--Signatory--</option>';

//Iterates extracted signatories into a drop down list
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
if(isset($_POST['submit']))
{
   
    //Gets the selected Section
    $sub= mysql_escape_string($_POST['sub']);
    
    //Gets the selected signatory
    $teacher= mysql_escape_string($_POST['teacher']);

    //Gets the fields of sections
    $fields= mysql_query("DESCRIBE sections");
   
    //Inititalize Query
    $query="UPDATE sections SET";
    
    
    $check=1;
    $check2=0;
    
    //Checks the empty fields and if not empty add to fields to be updated
    while($row = mysql_fetch_row($fields))
    {
            $val=$row[0];
            $queryp='';
            $checkt=$check;

            if(($val=='adviser')&&($teacher!=0))
            {
                    $queryp.=" adviser = '$teacher' ";
                    $checkt++;
                    $check2++;
            }

            if(($checkt!=$check)&&($check2!=1))
                    $queryp=" , ".$queryp;
            $query.=$queryp;
    }
    $query.= " WHERE secid ='$sub'";
    $result = mysql_query($query ) or die ("<p>Error in query: $query." . mysql_error().'</p>');
    echo '<script type="text/javascript">alert("Update Successful")</script>';
}
$clr->footer();
?>