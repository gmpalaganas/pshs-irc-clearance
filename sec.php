<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Year Levels','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Year Levels', $_SERVER['PHP_SELF'], 1);
$trail->output();
?>
<p><h1>Year Levels</h1></p>
<a href="set_section.php?yrlevel=1">1st Year</a><br>
<a href="set_section.php?yrlevel=2">2nd Year</a><br>
<a href="set_section.php?yrlevel=3">3rd Year</a><br>
<a href="set_section.php?yrlevel=4">4th Year</a><br>
<?php
$clr->footer();
?>