<?php
    $username = $_POST['username'];
    
    mysql_connect("localhost",'root','');
    mysql_select_db('clearance');

    //Checks if username exists
    $result = mysql_query("SELECT COUNT(*) FROM accounts WHERE username = '$username'") or die (mysql_error());
    $count = mysql_fetch_row($result);
    
    if($count[0]!=0)
    {
            //Password becomes the same with password
            mysql_query("UPDATE accounts SET pword = md5('$username') WHERE username = '$username'") or die (mysql_error());
            header("location:reset.php?success=1");
    }
    else
    {
            echo $count[0];
           header("location:reset.php?success=0");
    }
?>