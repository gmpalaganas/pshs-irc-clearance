<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Create Account','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Create Account', $_SERVER['PHP_SELF'], 1);
$trail->output();
?>
    <p><h1>Create Account</h1></p>
    <a href="signup.php">Create New Student Accounts</a>
<?php
$clr->footer();
?>