<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$clr = new Clearance('Home', '');
$trail->add('Compose Message', $_SERVER['PHP_SELF'], 1);
$clr->header();
$trail->output();


mysql_connect('localhost','root','');
mysql_select_db('clearance');


$id = $_SESSION['id'];//Gets the ID of the current user

echo '<h1>Compose Message</h1>';
?>
<table id="table">
    <tr><th colspan="2">Message</th></tr>
    <tr>
    <form action="compose_msg.php" method="post">
        <td>Recipient</td><td>
            <select name="to">
                <?php
                
                    //Gets the the Possible Resipients of the Message
                    $result = mysql_query("SELECT stid,lname,fname FROM  signatory JOIN  related ON stid = id2 WHERE id1 =$id") or die(mysql_error());
                    $result2 = mysql_query("SELECT stid,lname,fname FROM signatory JOIN related ON stid = id1  WHERE id2 =$id") or die(mysql_error());
                    
                    while($val = mysql_fetch_row($result))
                    {
                        echo "<option value='$val[0]'>$val[1],$val[2]</option>";
                    }
                    
                    while($val = mysql_fetch_row($result2))
                    {
                        echo "<option value='$val[0]'>$val[1],$val[2]</option>";
                    }
                ?>
            </select></td></tr>
            <tr><td colspan="2" align="center">
            <textarea name="msg" cols="70" rows="14" maxlenght="255"></textarea>
                </td></tr>
            <tr><td colspan="2" align="center"><input type="submit" name="sub" value="Send"></input></td></tr>
    </form>
    </tr>
</table>
<?php

//Message saved to the database
if(isset($_POST['sub']))
{
 $to = $_POST['to'];
 $msg = mysql_escape_string($_POST['msg']);
 $query = "INSERT INTO messages (to_id,from_id,message,date_sent) VALUES ($to,$id,'$msg',NOW())";
 mysql_query($query) or die (mysql_error());
}
$clr->footer();
?>