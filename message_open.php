<html>
    <head>
        <title>Message</title>
        <link rel="stylesheet" href="css/general.css" type="text/css" />
    </head>
    <body>
<?php
$msgid = $_GET['msgid']; //Gets the Message ID

mysql_connect('localhost','root','');
mysql_select_db('clearance');

//Gets the message
$message = mysql_fetch_array(mysql_query("SELECT message FROM messages WHERE msgid= $msgid")) or die(mysql_error());

//Displays the message
echo "<center><textarea rows='18' cols=70 style='font-family:Arial;' readonly>$message[0]</textarea></center>";
?> 
    </body>
</html>