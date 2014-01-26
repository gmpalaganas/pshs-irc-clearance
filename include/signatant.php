
<style type="text/css"> 
ul,li
{
list-style:none;
text-align:left;
font-family:Arial;
}
ul.group
{
width:160px;
margin:0px;
padding:5px;
text-align:center;
padding:10px;
}

ul ul li
{
	list-style-image:url(css/img/bullet.png);
}

</style>
<script src="js/date.js" type="text/javascript"></script>
<?php
require("menu.php");
$menu = new Menu();
$id= $_SESSION['id'];
mysql_connect('localhost','root','');
mysql_select_db('clearance');
$msg = mysql_num_rows(mysql_query("SELECT * FROM related WHERE id1=$id or id2=$id")); //Check if user has related signatory
$notif = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM messages WHERE to_id = $id AND new_msg"));//Check for new messages
$parent[0] = "clearance";
$parent[1] = "account";
$parent[2]= "announce"; 
$child[0]= "clearance1";
$child[1]= "account1";
$child[2]= "announce1";
if($msg!=0){
    $parent[3] = "msg";
    $child[3]= "msg1";
}
$menu->add_item($parent,$child);
echo "
<ul class='group'>
<li style='color:#fff799;'><center><b>MENU</b></center></li>
<li><a href='index.php'>Home</a></li>
<li><a href='faq.php'>About</a></li>
<li id='clearance'>Student Clearance</li>
<ul id='clearance1'>
<li><a href='sig_subjects.php'>Subjects</a></li>
<li><a href='sig_clubs.php'>Clubs</a></li>
<li><a href='sig_non.php'>Non-teaching</a></li>
<li><a href='advisory.php'>Advisory Class</a></li>
</ul>
<li id='announce'>Announce</li>
<ul id='announce1'>
<li><a href='ann_sub.php'>Subjects</a></li>
<li><a href='ann_club.php'>Clubs</a></li>
<li><a href='ann_non.php'>Non-teaching</a></li>
</ul>";

if($msg !=0)
    echo 
        "<li id='msg'>Messages</li>
        <ul id='msg1'>
        <li><a href='related.php'>Inbox ($notif[0])</a></li>
        <li><a href='compose_msg.php'>Send Message</a></li>
        </ul>";

echo "<li id='account'>Account</li>
<ul id='account1'>
<li><a href='password.php'>Change Password</a></li>
<li><a href='logout.php'>Logout</a></li>
</ul>
</ul>";

?>