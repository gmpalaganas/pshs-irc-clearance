<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Non-Teaching','student');
mysql_connect('localhost','root','');
mysql_select_db('clearance');
$clr->header();

$id = $_SESSION['id'];//Gets the ID of the current user

include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Non-Teaching', $_SERVER['PHP_SELF'], 1);
$trail->output();
mysql_query("UPDATE st_non_teaching SET notif = 0 WHERE stid = $id") or die (mysql_error()); //Sets the notification to 0
?>

<p><h1>Non-Teaching</h1></p>
		
		<table id="table">
		<tr>
		<th><b>Description</b></th>
		<th><b>Cleared</b></th>
		<th><b>Comments</b></th>
		</tr><tr>
		<?php  
                 //Gets the non-teaching and their clearance status
		$query = "SELECT non_teaching.ot_id,des,cleared,comments FROM st_non_teaching INNER JOIN non_teaching USING (ot_id) WHERE stid ='$id'";
		$result=mysql_query($query) or die ("Error");
		$count2=0;
		while ($row = mysql_fetch_row($result))
		{
			$tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
			echo $tr;
			echo '<td><a href="sub_non_teaching.php?non='.$row[0].'">' . $row[1]. '</a></td>';
			echo "<td id='cleared' >$row[2]</td>";
			echo "<td>$row[3]</td>";
			echo '</tr>';
			$count2++;
		}
		echo '</table>';
$clr->footer();
?>