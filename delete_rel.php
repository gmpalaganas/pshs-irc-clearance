<?php

$connect = mysql_connect('localhost','root','') or die ("Unable to Connect!");
mysql_select_db('clearance') or die ("Unable to Select Database");

$query = "DELETE FROM related WHERE rel_id= ";


for($count=0;$count<sizeof($delete);$count++)
    $result = mysql_query($query. $delete[$count]) or die ('Error in query: $query.' . mysql_error());


header("location:relation_li.php");
?>
