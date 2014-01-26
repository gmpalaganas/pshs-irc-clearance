<?php
/**
 * This is the base file of the PHP files in the Clearance Class
 * 
 */
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Title Here','Role allowed to access here');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Title', $_SERVER['PHP_SELF'], 'Level');
$trail->output();
$clr->footer();
?>