<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Subjects','student');
mysql_connect('localhost','root','');
mysql_select_db('clearance');
$clr->header();


$id = $_SESSION['id']; //Gets the ID of the current user


mysql_query("UPDATE st_subjects SET notif = 0 WHERE stid = $id"); //Sets the notification to 0

include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Subjects', $_SERVER['PHP_SELF'], 1);
$trail->output();
?>

<p><h1>Subjects</h1></p>
		<table id="table">
		<tr>
		<th><b>Subjects</b></th>
		<th><b>Cleared</b></th>
		<th><b>Comments</b></th>
		</tr><tr>

		
		<?php 
                   //Gets the subjects and their clearance status
		$query = "SELECT subjects.sub_id,sub,cleared,comments FROM st_subjects, subjects WHERE stid ='$id' AND st_subjects.sub_id = subjects.sub_id";
		$subs=mysql_query($query) or die ("Error");
		$count2=0;
		while ($row = mysql_fetch_row($subs))
		{
			$tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
			echo $tr;
			echo '<td><a href="sub_announcement.php?sub='.$row[0].'">' . $row[1]. '</a></td>';
			echo "<td id='cleared''>$row[2]</td>";
			echo "<td>$row[3]</td>";
			echo '</tr>';
			$count2++;
		}
		echo '</table>';
		$clr->footer();
		?>