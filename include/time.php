<?php

mysql_connect('localhost','root');
mysql_select_db('clearance');


$result = mysql_query("SELECT DATE_FORMAT(NOW(),'%M %d, %Y %T')"); //Get Server time
$response = mysql_fetch_row($result);


echo $response[0];

?>