<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Clubs','');
mysql_connect('localhost','root','');
mysql_select_db('clearance');
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$clr->header();

$id = $_SESSION['id']; //Gets the ID of the current user

mysql_query("UPDATE st_clubs SET notif = 0 WHERE stid = $id"); //Sets the notification to 0

$trail = new Breadcrumb();
$trail->add('Clubs', $_SERVER['PHP_SELF'], 1);
$trail->output();
?>

<p><h1>Clubs</h1></p>
		<table id="table">
		<tr>
		<th><b>Clubs</b></th>
		<th><b>Cleared</b></th>
		<th><b>Comments</b></th>
		</tr><tr>

		
		<?php 
                //Gets the clubs and their clearance status
		$query = "SELECT clubs.club_id,club,cleared,comments FROM st_clubs INNER JOIN clubs ON club_id=clid WHERE stid ='$id'";
		$result=mysql_query($query) or die ("Error: ".mysql_error());		
		$count2=0;
		while ($row = mysql_fetch_row($result))
		{
			$tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
			echo $tr;
			echo '<td><a href="sub_club.php?club='.$row[0].'">' . $row[1]. '</a></td>';
			echo "<td id='cleared' >$row[2]</td>";
			echo "<td>$row[3]</td>";
			echo '</tr>';
			$count2++;
		}
		echo '</table>';
$clr->footer();
?>