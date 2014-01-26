<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('About','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('About', $_SERVER['PHP_SELF'], 1);
$trail->output();
?>
<p><h1>About</h1></p>

<p>
<ul><li><b>The PSHS-IRC Online Clearance aims:</b></li>
    <br/>
    <ul>
        <li>For a faster and more efficient signing of clearance</li>
        <li>For a easier management of the signing of clearance</li>
        <li>For faster retrieval of documents</li>
    </ul>
</ul>
</p>

<p>
    <ul><li><b>Why was the system developed?</b></li>
    <br/>
    <ul>
        <li>To help the developers' fellow students, their teachers and the staffs of PSHS-IRC</li>
        <li>It was requested by Sir Pablo Viloria Jr PhD who was the the SSD Chief by that time and the developers' Computer Science 4 teacher</li>
        <li>Their research was about the development of this system <br/>(<i> Develpment of the Philippine Science High School Ilocos Region Campus Online Clearance System </i>)</li>
    </ul>
</ul>
</p>

<p>
    <ul><li><b>Reason behind the banner design</b></li>
    <br/>
    <ul>
        <li>The banner design represents the use of <i>Cloud Computing</i> in the system wherein information are provided to a computer over a network</li>
        <li>For more information about Cloud Computing read the <a href="http://en.wikipedia.org/wiki/Cloud_computing">Cloud Computing article</a> on Wikipedia </li>
    </ul>
</ul>
</p>

<table id="table" class="about">
<tr><th colspan="2">Credits</th><tr>
<tr><td>Chief Developer/Systems Analyst/Interface Designer</td><td>Genesis Ian M. Palaganas</a></td></tr>
<tr><td rowspan="4">Co-developers/Technical Writers</td><td>Carl Peter Christian  C. Caampued</td></tr>
<tr><td>Austin Paolo S. Chua</td></tr>
<tr><td>Geo Bernie O. Ferrer</td></tr>
<tr><td>Ydnel  Hilario</td></tr>
<tr><td rowspan="2">Advisers</td><td>Pablo Viloria</td></tr>
<tr><td>Michelle Ducusin</td></tr>
<tr><td rowspan="2">Special Thanks:</td><td>David Christy Ann T. Nacar (banner design)</td></tr>
<tr><td>Daniel Villacorta</td></tr>
</table>
<br/>
<?php
 $clr->footer();
?>