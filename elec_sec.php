<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Elective Sections','administrator');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Elective Sections', $_SERVER['PHP_SELF'], 1);
$trail->output();
?>
<p><h1>Elective-Sections</h1></p>
<?php
mysql_connect('localhost','root','');
mysql_select_db('clearance');

//Gets the sections of the 3rd years and 4th years
$query = "SELECT secid,section FROM sections WHERE secid IN (SELECT secid FROM st_sec WHERE stid IN (SELECT stid FROM students WHERE yrlevel > 2))";
$sections = mysql_query($query);


echo '<table id = "table">';
        echo '<tr><th>Section</th></tr>';
        $count2= 0;
        //Iterate sections extracted
        while ($row = mysql_fetch_row($sections))
        {
                $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
                echo $tr;
                echo '<td><a href ="elective.php?secid='.$row[0].'">'.$row[1].'</td></tr>';
                $count2++;
        }
        echo '</table>';
$clr->footer();
?>