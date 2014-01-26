<?php
session_start();
if (isset($_SESSION['username']))
{
$uname = $_SESSION["username"]; //Gets user's username

mysql_connect('localhost','root','');
mysql_select_db('clearance');


$res = mysql_query("SELECT COUNT(*) FROM accounts WHERE username = '$uname' AND  pword = MD5('".$_POST['old_pword']."')") or die("ERROR:" . mysql_error());
$check = mysql_fetch_row($res);


if(($_POST['n_pword']==$_POST['rn_pword']) AND ($check[0]!=0)){ //Checks if old password is correct AND new Password and re-typed Password matches
        $query = "UPDATE accounts SET pword = md5('". $_POST['n_pword'] ."') WHERE id = '".$_SESSION['id']."'";
        mysql_query($query) or die ('Error:' . mysql_error());
        echo $_SESSION['id'];
        header('location:index.php?change=0');
}
else
        header('location:password.php?fail=0');
        echo $check[0];
}
echo "Username not set"
?>