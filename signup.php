<?php

//Checks if for signatory or for student
$role = (isset($_GET['signatory']))?'signatant':'student';


$connection=mysql_connect('localhost','root','') or die ("Unable to Connect");
mysql_select_db('clearance');

/*Sets username as lastname,first letter of first name, the middle initial all lower caps
 * i.e. 
 * Name: Genesis Ian M. Palaganas
 * Username: palaganasgm
 */
$query = "SELECT stid,LCASE(CONCAT(lname,MID(fname,1,1),MID(mname,1,1))) username FROM";


//Checks if for signatory then create accounts for those who do not have accounts yet

if($_GET['signatory'])
        $query.= " signatory WHERE stid NOT IN (SELECT id FROM accounts)";
else
        $query.= " students WHERE stid NOT IN (SELECT id FROM accounts)";


$stid = mysql_query($query);
while($row = mysql_fetch_row($stid))
{
        mysql_query("INSERT INTO accounts VALUES ('$row[1]',MD5('$row[1]'),'$role',$row[0])");
}
header('location:index.php?create=0');
?>
