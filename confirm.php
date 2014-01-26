<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<?php
	
	session_start();

	mysql_connect('localhost', 'root', '')or die("cannot connect");
	mysql_select_db('clearance')or die("cannot select DB");
	
        //Gets user input
	$myusername=$_POST['username'];
	$mypassword=$_POST['password'];

        //Anti code injection
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);
        
        setcookie('username',$myusername,mktime()+86400,'/'); //Sets Cookies for username
        
        
	$query="SELECT * FROM accounts WHERE username='$myusername' and pword=md5('$mypassword')"; //Verify username and password
	$result=mysql_query($query);
	$count=mysql_num_rows($result);
	$val = mysql_fetch_row($result);
	
	if($count==1){
	$_SESSION['username']= $myusername;
	$_SESSION['role']= $val[2];
	$_SESSION['id']=$val[3];
	header("location:../pshs-irc-clearance");
	}
	else {
	header("location:login.php?wrong=1");
	}
	
	?>
