
<script type="text/javascript">
   function choice1(){ //Enables list of subjects and Disables list of clubs and non-teaching
       var sub = document.getElementById('sub3');
       var club = document.getElementById('club3');
       var non = document.getElementById('non3');
           sub.hidden = false;
           sub.disabled = false;
           
           club.hidden = true;
           club.disabled = true;
           
           non.hidden = true;
           non.disabled = true;
           
   }
       
   function choice2(){ //Enables list of club and Disables list of subjects and non-teaching
       var sub = document.getElementById('sub3');
       var club = document.getElementById('club3');
       var non = document.getElementById('non3');
           club.hidden = false;
           club.disabled = false;
           
           sub.hidden = true;
           sub.disabled = true;
           
           non.hidden = true;
           non.disabled = true;
   }
   
   function choice3(){ //Enables list of non-teaching and Disables list of clubs and subjects
       var sub = document.getElementById('sub3');
       var club = document.getElementById('club3');
       var non = document.getElementById('non3');
           non.hidden = false;
           non.disabled = false;
           
           sub.hidden = true;
           sub.disabled = true;
           
           club.hidden = true;
           club.disabled = true;
   }           
</script>



<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Unclear Student','administrator');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Unclear Students', $_SERVER['PHP_SELF'], 2);
$trail->output();

//Gets the selected year level
$yrlevel = (isset($_GET['yr']))?$_GET['yr']:$_SESSION['yr'];
$_SESSION['yr'] = $yrlevel;


mysql_connect('localhost','root','');
mysql_select_db('clearance');

//Gets the students in the selected year level
$query = "SELECT stid,lname,fname FROM students WHERE yrlevel = '$yrlevel' ORDER BY lname";
$students = mysql_query($query) or die(mysql_error());

//Gets the subjects of tje selected year level
$query2 = "SELECT sub_id,sub FROM subjects WHERE yrlevel = '$yrlevel'";
$subjects= mysql_query($query2);

//Gets the clubs
$query2 = "SELECT club_id,club FROM clubs";
$clubs= mysql_query($query2);

//Gets the non-teaching
$query2 = "SELECT ot_id,des FROM non_teaching";
$non = mysql_query($query2);
?>

<p><h1>Set Students</h1></p>
<form action="unclear_st.php" method="post">
    <table id="table"><tr><th colspan="2">Subjects/Clubs/Non-teaching</th></tr><tr><td>
        <input type="radio" name="choice" onclick="choice1();" checked value="subject"></radio>Subjects<br/>
        <input type="radio" name="choice" onclick="choice2();" value="club"></radio>Clubs<br/>
        <input type="radio" name="choice" onclick="choice3();" value="non"></radio>Non-teaching<br/>
                
            </td><td align = "center">
<select name="subject" id="sub3">
<?php

//Iterate subjects into a drop down list
while($row = mysql_fetch_row($subjects))
{
    echo '<option value="'.$row[0].'">'."$row[1]</option>";
}

echo '</select>';
?>

<select name="subject" id="club3" hidden disabled>
<?php

//Iterate clubs into a drop down list
while($row = mysql_fetch_row($clubs))
{
    echo '<option value="'.$row[0].'">'."$row[1]</option>";
}

echo '</select>';
?>
<select name="subject" id="non3" hidden disabled>
    
<?php

//Iterate non-teaching into a drop down list
while($row = mysql_fetch_row($non))
{
    echo '<option value="'.$row[0].'">'."$row[1]</option>";
}
echo '</select>';


echo '</td></tr></table>';
echo '<table id="table">
<tr><th>Check</th><th>Student</th></tr>';
while ($row = mysql_fetch_row($students))
{
    echo '<tr><td><input type="checkbox" name="students[]" value = "'.$row[0].'"></td>'."<td>$row[1],$row[2]</td></tr>";
}
echo "</table>"
?>
<input type="submit" name="SUBMIT"></form>
<?php


if(isset($_POST['SUBMIT']))
{
    $students = (isset($_POST['students']))?$_POST['students']:die('<script type="text/javascript">alert("No Student Selected.");</script>');
    $subject = $_POST['subject'];
    $choice = $_POST['choice'];
    
    /*
     * Checks choice the sets the $table and $id variables
     * $table refers to the table in the database which will be UPDATED
     * $id refers to the field in the table containing the ID number of the selected
     */
    if($choice == 'subject')
    {
        $table = 'st_subjects';
        $id = "sub_id";
    }
    
    else if($choice == 'club')
    {
        $table = 'st_clubs';
        $id = "clid";
    }
    
    else if($choice == 'subject')
    {
        $table = 'st_non_teaching';
        $id = "ot_id";
    }
    
    //Unclears the selected students
    foreach($students as $val)
    {
        $query = "UPDATE $table SET cleared = 'NOT CLEARED', date_signed = NULL WHERE stid = $val AND $id= $subject";
        mysql_query($query) or die ("ERROR in query $query: ". mysql_error());
    }
    
    echo '<script type="text/javascript">alert("Successful");</script>';
}
$clr->footer();
?>