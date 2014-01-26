<?php
    $username = $_POST['username'];
    
    mysql_connect("localhost",'root','');
    mysql_select_db('clearance');

    //Checks if username exists
    $result = mysql_query("SELECT COUNT(*) FROM accounts WHERE username = '$username'") or die (mysql_error());
    $count = mysql_fetch_row($result);
    if($username == 'admin')
       header("location:delete_user.php?admin=1");
        
    if($count[0]!=0)
    {
            //Password becomes the same with password
            mysql_query("DELETE FROM accounts WHERE username = '$username'") or die (mysql_error());
            header("location:delete_user.php?success=1");
    }
    else
    {
            echo $count[0];
           header("location:delete_user.php?success=0");
    }
?>
