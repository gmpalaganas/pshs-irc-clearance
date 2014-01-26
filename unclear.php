<?php
mysql_connect('localhost','root','');
mysql_select_db('clearance');

//UNCLEARS ALL ITEMS IN CLEARANCES OF ALL STUDENTS
mysql_query("UPDATE st_subjects SET date_signed = null , cleared = DEFAULT WHERE year2 = (SELECT DATE_FORMAT(NOW(),'%Y')) OR year = (SELECT DATE_FORMAT(NOW(),'%Y')-1)");
mysql_query("UPDATE st_clubs SET date_signed = null , cleared = DEFAULT WHERE year2 = (SELECT DATE_FORMAT(NOW(),'%Y')) OR year = (SELECT DATE_FORMAT(NOW(),'%Y')-1)");
mysql_query("UPDATE st_non_teaching SET date_signed = null , cleared =DEFAULT WHERE year2 = (SELECT DATE_FORMAT(NOW(),'%Y')) OR year = (SELECT DATE_FORMAT(NOW(),'%Y')-1)");
mysql_query("UPDATE st_sec SET date_signed = null, cleared =DEFAULT WHERE year2 = (SELECT DATE_FORMAT(NOW(),'%Y')) OR year = (SELECT DATE_FORMAT(NOW(),'%Y')-1)");


header("location:st_sect.php?suc=true");


?>
