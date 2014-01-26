
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
			$res;
			mysql_connect('localhost','root','');
			mysql_select_db('clearance');
			if($_SESSION['role']=="student")
			{
				$id = $_SESSION['id'];
				$query = "SELECT COUNT(notif) FROM ";
				$a = array('st_subjects','st_non_teaching','st_clubs','st_sec');
				$res = array();
				foreach($a as $val)
				{
					$query2 = $query.$val. " WHERE stid = $id AND notif = TRUE";
					$res[] = mysql_fetch_row(mysql_query($query2));
				}
			}
			$sub = '('. $res[0][0] . ')';
			$club = '(' .  $res[2][0]. ')' ;
			$non = '(' . $res[1][0]. ')';
                        $sec = '(' . $res[3][0]. ')';
require("include/menu.php");
$menu = new Menu();
$parent[0] = "clearance";
$parent[1] = "account";
$child[0]= "clearance1";
$child[1]= "account1";
$menu->add_item($parent,$child);
echo "
<ul class='group'>
<li style='color:#fff799;'><center><b>MENU</b> </center></li>
<li><a href='index.php'>Home</a></li>
<li><a href='faq.php'>About</a></li>
<li id='clearance'><div class='c'>Clearance</div></li>
<ul id='clearance1'>
<li><a href='subjects.php'>Subjects</a> $sub</li>
<li><a href='clubs.php'>Clubs </a> $club</li>
<li><a href='non_teaching.php'>Non-teaching</a> $non</li>
<li><a href='sections.php'>Section</a> $sec</li>
<li><a href='download.php'>Download Clearance</a></li>
</ul>
<li id='account'>Account</li>
<ul id='account1'>
<li><a href='password.php'>Change Password</a></li>
<li><a href='logout.php'>Logout</a></li>
</ul>
</ul>";

?>