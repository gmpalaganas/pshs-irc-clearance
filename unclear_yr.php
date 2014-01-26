<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$clr = new Clearance('Unclear', 'administrator');
$trail->add('Year Level', $_SERVER['PHP_SELF'], 1);
$clr->header();
$trail->output();
?>
<h1>Unclear Student</h1>
<a href="unclear_st.php?yr=1">1st Year</a><br/>
<a href="unclear_st.php?yr=2">2nd Year</a><br/>
<a href="unclear_st.php?yr=3">3rd Year</a><br/>
<a href="unclear_st.php?yr=4">4th Year</a><br/>

<?php
$clr->footer();
?>