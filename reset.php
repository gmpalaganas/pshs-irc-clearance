<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Reset Password','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Reset Password', $_SERVER['PHP_SELF'], 1);
$trail->output();
?>
<p><h1>Reset User Password</h1></p>
<form action="reset_password.php" method="post">
        <table id="table">
        <tr><th>Username</th><th>Reset</th></tr>
        <tr><td width="150"><input type="text" name="username" size=50 ></td><td width="50"><input type="submit" value="Reset"></td></tr>
        </table>
</form>
<?php
if(isset($_GET['success'])){
if(!($_GET['success']))
    echo "<script language='Javascript'>alert('Username does not exist');</script>";
else
    echo "<script language='Javascript'>alert('Success');</script>";
}
$clr->footer();
?>