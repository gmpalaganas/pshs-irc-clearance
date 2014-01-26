
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

$parent[0] = "students";
$parent[1] = "account";
$parent[2] = "signatory";
$parent[3] = "subjects";
$parent[4] = "clubs";
$parent[5] = "non";
$parent[6] = "sec";
$parent[7] = "macc";

$child[0]= "students1";
$child[1]= "account1";
$child[2] = "signatory1";
$child[3] = "subjects1";
$child[4] = "clubs1";
$child[5] = "non1";
$child[6] = "sec1";
$child[7] = "macc1";

$menu->add_item($parent,$child);
echo "
<ul class='group'>
<li style='color:#fff799;'><center><b>MENU</b></center></li>
<li><a href='index.php'>Home</a></li>
<li><a href='faq.php'>About</a></li>
<li id='students'>Students</li>
<ul id='students1'>
<li><a href='st_sect.php'>List</a></li>
<li><a href='unclear_yr.php'>Unclear</li>
<li><a href='record_alumni.php'>Alumni</a></li>
<li><a href='insert_student.php'>Insert</a></li>
<li><a href='update_st.php'>Update</a></li>
<li><a href='set_subs.php'>Set Subjects</a></li>
<li><a href='elec_sec.php'>Set Elective</a></li>
<li><a href='club_sec.php'>Set Club</a></li>
<li><a href='sec.php'>Set Section</a></li>
<li><a href='advance.php'>Year Level</a></li>
<li><a href='sign_student.php'>Create Account</a></li>
</ul>

<li id='signatory'>Signatory</li>
<ul id='signatory1'>
<li><a href='signatant.php'>List</a></li>
<li><a href='insert_signatant.php'>Insert</a></li>
<li><a href='update_sig.php'>Update</a></li>
<li><a href='relation_li.php'>Relations</a></li>
<li><a href='set_related.php'>Add Relation</a></li>
<li><a href='sign_signatant.php'>Create Account</a></li>
</ul>

<li id='subjects'>Subjects</li>
<ul id='subjects1'>
<li><a href='subjects_li.php'>List</a></li>
<li><a href='input_sub.php'>Insert</a></li>
<li><a href='update_sub.php'>Update</a></li>
</ul>

<li id='clubs'>Clubs</li>
<ul id='clubs1'>
<li><a href='clubs_li.php'>List</a></li>
<li><a href='input_club.php'>Insert</a></li>
<li><a href='update_club.php'>Update</a></li>
</ul>

<li id='non'>Non-teaching</li>
<ul id='non1'>
<li><a href='non_li.php'>List</a></li>
<li><a href='input_non.php'>Insert</a></li>
<li><a href='update_non.php'>Update</a></li>
</ul>

<li id='sec'>Sections</li>
<ul id='sec1'>
<li><a href='sec_li.php'>List</a></li>
<li><a href='input_sec.php'>Insert</a></li>
<li><a href='update_sec.php'>Update</a></li>
</ul>

<li id='macc'>User Accounts</li>
<ul id='macc1'>
<li><a href='reset.php'>Reset Password</a></li>
<li><a href='delete_user.php'>Delete</a></li>
</ul>

<li id='account'>Account</li>
<ul id='account1'>
<li><a href='password.php'>Change Password</a></li>
<li><a href='logout.php'>Logout</a></li>
</ul>
</ul>";

?>