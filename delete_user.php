<?php

include('include/clearance.php');
include("breadcrumbs.php");
$trail = new Breadcrumb();
$clr = new clearance('Delete User', 'administrator');
$trail->add('Delete User', $_SERVER['PHP_SELF'], 1);
$clr->header();
$trail->output();
?>
<p><h1>Delete User</h1></p>
<form action="del_usr.php" method="post">
        <table id="table">
        <tr><th>Username</th><th>Delete</th></tr>
        <tr><td width="150"><input type="text" name="username" size=50 ></td><td width="50"><input type="submit" value="Delete"></td></tr>
        </table>
</form>
<?php
if(isset($_GET['success'])){
if(!($_GET['success']))
    echo "<script language='Javascript'>alert('Username does not exist');</script>";
else
    echo "<script language='Javascript'>alert('Success');</script>";
}

if(isset($_GET['admin'])){
    echo "<script language='Javascript'>alert('Cannot delete Admin account');</script>";

}

$clr->footer();
?>