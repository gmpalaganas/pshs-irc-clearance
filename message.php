<?php
mysql_connect('localhost', 'root', '');
mysql_select_db('clearance');
mysql_query("UPDATE messages SET new_msg = 0");
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$clr = new Clearance('Messages', 'signatant');
$clr->header();
$trail = new Breadcrumb();
$trail->add('Messages', $_SERVER['PHP_SELF'], 2);
$trail->output();


$id = $_SESSION['id']; //Gets the current user's ID number

//Gets the related users to the current user
$from = isset($_GET['id'])?$_GET['id']:$_SESSION['id2'];
$_SESSION['id2'] = $from;
$name = mysql_fetch_array(mysql_query("SELECT lname,fname FROM signatory WHERE stid=$from"));


echo "<h1>Messages from $name[0],$name[1]</h1>";
echo '<table id="table">';
echo '<tr><th>Messages</th><th>Delete</th></tr>';

//Gets the Message ID and the Date Sent
$query = "SELECT DATE_FORMAT(date_sent,'%W | %M %d, %Y | %r '),msgid FROM messages WHERE from_id = $from AND to_id=$id ORDER BY date_sent";
$result = mysql_query($query) or die (mysql_error());

?>
<style type="text/css">
    #data:hover{
        background-color:#77B8EF;        
    }
</style>
<form action='delete_msg.php' method="post">
<?php
if(mysql_num_rows($result)!=0)
{
    $count = 0;
    while($val = mysql_fetch_row($result))
    {
        echo "<script type='text/javascript'>";
        //Opens new Modal Window that shows the message
        echo "function open$count()
        {
            ".'window.showModalDialog("message_open.php?'."msgid=$val[1]".'","","resizeable:0");'."
        }";
        echo "</script>";
           echo "<tr><td id='data' onclick='open$count();' style='cursor:pointer;'>$val[0] </td> <td><input type='checkbox' name='delete[]' value='$val[1]'></td></tr>";
           $count++;
    }
}
else {
    echo "<tr><td colspan = 2>You have no messages from $name[0],$name[1]</td></tr>";    
}
echo "<tr><td colspan =2><input type='submit' value='Delete'></td></tr>";
echo '</table>';
$clr->footer();
?>
</form>