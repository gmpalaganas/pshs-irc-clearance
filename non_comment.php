<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Announce','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Announce', $_SERVER['PHP_SELF'], 2);
$trail->output();
?>
<h1>Announce<h1>
<?php
$title = isset($_GET['sub'])?$_GET['sub']:$_POST['sub'];
mysql_connect('localhost','root','') or die ('Unable to connect');
mysql_select_db('clearance');

//Gets the current announcement of the selected non-teaching
$result = mysql_query("SELECT announce FROM non_teaching WHERE ot_id = '$title'") or die ("Error in query: $query." . mysql_error());
$subject = mysql_fetch_row($result);

//Sets new Non-teaching Announcement
if(isset($_POST['submit']))
{
        $date = mysql_fetch_row(mysql_query("SELECT DATE_FORMAT(NOW(),'%M %d, %Y - %W %h:%i %p')"));
        mysql_query("UPDATE non_teaching SET announce ='".mysql_escape_string($_POST['comment'])."',post_date = '$date[0]' WHERE ot_id = '$title'") or die('Error');
        header("location:ann_non.php");
}
        echo '<div class="select">'.'<form action="sub_comment.php?sub='.$title.'" method="post">';
        echo '<input type="radio" name="sub" value="'.$title.'" style="display:none" checked>';
        echo '<textarea name="comment" rows="15" cols="50">'.$subject[0].'</textarea><br>';
                echo '<input type="submit" name="submit" value="Submit"></form>';
                
                
$clr->footer();
?>