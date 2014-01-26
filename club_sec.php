<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Clubs-Sections','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Clubs-Sections', $_SERVER['PHP_SELF'], 1);
$trail->output();
?>

<p><h1>Clubs-Sections</h1></p>
<?php
mysql_connect('localhost','root','');
mysql_select_db('clearance');

//Gets the Current Year, the Next Year and the Previous Year respectively
$query = "SELECT DATE_FORMAT(NOW(),'%Y'), DATE_FORMAT(NOW(),'%Y') + 1,DATE_FORMAT(NOW(),'%Y') - 1";
$result = mysql_query($query);
$year1 = mysql_fetch_array($result);

//Gets the all the sections
$query = "SELECT secid,section FROM sections";
$sections = mysql_query($query);

echo '<table id = "table">';
        echo '<tr><th>Section</th></tr>';
        $count2= 0;
        
        //Iterate the sections
        while ($row = mysql_fetch_row($sections))
        {
                $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
                echo $tr;
                echo '<td><a href ="set_clubs.php?secid='.$row[0].'">'.$row[1].'</td></tr>';
                $count2++;
        }
        echo '<tr><td><a href="add_all_club.php?yr1='."$year1[0]&yr2=$year1[1]".'">Add all to SA and SMT for '."$year1[0]-$year1[1]".'</a></td></tr>';
        echo '<tr><td><a href="add_all_club.php?yr1='."$year1[2]&yr2=$year1[1]".'">Add all to SA and SMT for '."$year1[2]-$year1[0]".'</a></td></tr>';
        echo '</table>';
$clr->footer();
?>