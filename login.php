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
<title>Login</title>
<link rel="shortcut icon" href="css\img\pisay.ico">
<link rel="stylesheet" href="css/general.css" type="text/css" />
<script language="Javascript">
function validate() /*Validate user inputs*/ {
	if(document.getElementById("username").value.length==0) {
		alert("Enter username.");
		document.getElementById("username").focus();
		return false;
	}
	if(document.getElementById("password").value.length==0) {
		alert("Enter password.");
		document.getElementById("password").focus();
		return false;
	}
	return true;
}

function focus_on(){
    var username = document.getElementById("username");
    var password = document.getElementById("password");
    if (username.value.length != 0)
        password.focus();
    else if (username.value.lenght == 0)
        username.focus(); 
}
</script>
</head>

<body onLoad="focus_on();">

<?php

        if(isset($_SESSION['id']))
            header("location:../pshs-irc-clearance/");
	if(isset($_GET['wrong'])&&$_GET['wrong'])
		echo '<script type="text/javascript">alert("Invalid username/password");</script>';
?>
    
<form method="post" action="confirm.php" name="loginform" onsubmit="return validate();">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td align="center" valign="middle">
    <!--LOGIN BOX-->
<div id="box">
<div>
<img src="css/img/banner-3.png" height="75px" width="474px">
</div>

<br/>

<div>
<label for="username" class="login">Login Name</label>
<input type="text" name="username" id="username" <?php if(isset($_COOKIE['username'])) echo "value='".$_COOKIE['username']."'"; ?>>
</div>

<div>
<label for="password" class="login">Password</label>
<input type="password" name="password" id="password">
</div>

<br style="clear:both">

<div id="buttons">
<input type = "submit" accesskey="s" value="Login" id="submit" name="submit">
<input type = "reset" accesskey="r" id="reset" name="reset" onClick="form.username.focus();"> 
</div>
</div>     
</td>
</tr>   
</table>
</form>
</body>
</html>