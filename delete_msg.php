<?php
mysql_connect('localhost', 'root', '');
mysql_select_db('clearance');

$query = "DELETE FROM messages WHERE msgid= ";
$delete = $_POST['delete'];

//Deletes selected messages
for($count=0;$count<sizeof($delete);$count++)
    $result = mysql_query($query. $delete[$count]) or die ('Error in query: $query.' . mysql_error());
header('location:message.php');
?>
