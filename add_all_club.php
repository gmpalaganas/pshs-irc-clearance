<?php

mysql_connect('localhost','root');
mysql_select_db('clearance');

//Get the School Year
$yr1 = $_GET['yr1'];
$yr2 = $_GET['yr2'];

//Get the ID number of SMT and SA Club
$query = "SELECT club_id FROM clubs WHERE club = 'Student Alliance' or club = 'SMT' or club = 'SA' or club = 'Science, Math and Technology'";
$result  = mysql_query($query);

//Add students to clubs for the school year
while($row = mysql_fetch_row($result))
{
       //GET the ID number of the students
      $subs = mysql_query("SELECT stid FROM students WHERE yrlevel <= 4");
        while($row2 = mysql_fetch_row($subs))
        {
                //Insert now the data into database
                mysql_query("INSERT INTO st_clubs (stid,clid,year,year2) VALUES ($row2[0],$row[0],$yr1,$yr2)");
        }
   
}

header('location:club_sec.php');
?>
