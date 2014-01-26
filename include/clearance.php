<?php
/*
 * Clearance Class
 * Developer: Genesis Ian M. Palaganas
 * 
 * This class is used as a basis for most of the pages
 * in the PSHS-IRC Online Clearance System. It contains the
 * header and footer functions designed for easier development
 * of pages involved in the system
 */

class Clearance
{

private $title = '';
private $role = '';
private $deadline = "March 23, 2012 17:00:00"; //Deadline of Signing

function __construct($inTitle,$inRole) //Constructor
{
	$this->title = $inTitle; //For the title property of the page
	$this->role = $inRole; //For restrictions of the page
}

function header() 
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<!--
    Philippine Science High School - Ilocos Region Campus Online Clearance System
    Developer: Genesis Ian M. Palaganas
    Banner Design: David Christy Ann T. Nacar
    Breadcrumbs: Mick Sear (http://www.ecreate.co.uk)
    Special Thanks: 
        Pablo Viloria Jr
        Carl Peter Christian Caampued
        Geo Bernie Ferrer
        Ydnel Hilario
        Austin Paolo Chua
        Daniel Villacorta
-->
<html>
<head>
	<link rel="shortcut icon" href="css/img/pisay.ico">
	<script language="Javascript" src="include/jquery.js"></script>
	<link rel="stylesheet" href="css/general.css" type="text/css" />
        <script type="text/javascript" src="include/date.js"></script>
	<title><?php echo $this->title; ?></title>
	</head>
        <!--BEGIN HEADER-->
	<body onload="getTime();"> <!--getTime() gets the time before end of signing of clearance-->
		<?php
		session_start();
		if(!isset($_SESSION['role']))
			header("location:login.php");
		if(isset($_GET['change']))
			echo '<script type="text/javascript">alert("Sucessful: Changed Password"); </script>';
		?>
		<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td class='menu' valign='center'>
	<?php
        echo "<!--BEGIN MENU-->";
	if($_SESSION['role']=='student')
		require('include/student.php');
	else if($_SESSION['role']=='signatant')
		require('include/signatant.php');
	else if($_SESSION['role']=='administrator')
		require('include/admin.php');
        echo "<!--END MENU-->";
	?>
		</td>
		<td align="center" valign="center" rowspan='3'>
		<!--CONTAINER--> <div id="group"> 
                    
<!--BEGIN BANNER-->
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="1000" height="150" id="genesis banner" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="include/banner.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="include/banner.swf" quality="high" bgcolor="#ffffff" width="1000" height="150" name="genesis banner" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
<!--END BANNER--> 
                    
<!--END HEADER-->

<?php
	if($this->role!='')
	{
	if($_SESSION['role']!=$this->role){
		header('location:index.php?allow=0');
	}
	}
        ?>

<!--BEGIN CONTENT-->

<?php
}

function footer()
{
?>
        <!--END CONTENT-->
        
        <!--BEGIN FOOTER-->
	<a href='http://www.irc.pshs.edu.ph'><img src='css/img/irc.png' id='watermark'/></a>
	</div>
		</td>
		</tr>
		<tr>
		<td height='500px' valign='center'>
                  <div id="txt"></div>
                  <!--WEB TRANSLATOR-->
		 <!--<script type="text/javascript" charset="UTF-8" language="JavaScript1.2" src="http://uk.babelfish.yahoo.com/free_trans_service/babelfish2.js?from_lang=en&region=us"></script> //-->
		
                </td>
		</tr> 
                </table>
            <!--END FOOTER-->
		</body>
</html>

<?php
}


}
?>