<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Home','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Home', $_SERVER['PHP_SELF'], 0);
$trail->output();
echo "<p><h1>Welcome</h1></p>";
 echo "<p><img src='css/img/Pisay.jpg' width='800px' height='200px' style ='-webkit-border-radius: 36px 12px;-moz-border-radius: 36px / 12px;  box-shadow: 0px 0px 10px #888888; -webkit-box-shadow: 0px 0px 10px #888888;'/></p>";
    		
                if($_SESSION['role']=='student') //Checks if user is a student
		{
			mysql_connect('localhost','root','');
			mysql_select_db('clearance');
                        
			$id = $_SESSION['id'];//Gets the ID number of the current user
                        
                                //Gets the number of items cleared in the users clearance
				$query = "SELECT COUNT(*) FROM ";
				$a = array('st_subjects','st_non_teaching','st_clubs','st_sec');
				$res = array();
				$res2 = array();
				foreach($a as $val)
				{
					$query2 = $query.$val. " WHERE stid = $id AND cleared = 'CLEARED'";
					$query3 =  $query.$val. " WHERE stid = $id";
					$res[] = mysql_fetch_row(mysql_query($query2));
					$res2[] = mysql_fetch_row(mysql_query($query3));
				}
				$sum = 0;
				$cleared = 0;
				foreach($res2 as $val)
					$sum += $val[0];
				foreach($res as $val)
					$cleared += $val[0];
                                
                                //Print the number of cleared items; color depends on the cleared items-total items ratio
				echo "<p id='notice'>You have CLEARED "; 
				if($cleared<=($sum * 0.25))
					echo "<font style='color:#f00;'>$cleared</font>";
				else if($cleared<=($sum * 0.50))
					echo "<font style='color:orange;'>$cleared</font>";
				else if($cleared<=($sum * 0.75))
					echo "<font style='color:yellow;'>$cleared</font>";
				else if($cleared<=($sum))
					echo "<font style='color:#0f0;'>$cleared</font>";
				echo " out of $sum items in your clearance</p>";
                                
		}
          else if($_SESSION['role']=="signatant") // Checks if user is a Signatory
          { 
              
              $id = $_SESSION['id']; //Gets the ID number of the current user
              
              //Gets the number of students with status NOT CLEARED in Subject, Non-teaching or Club user handles
              $query = "SELECT section,sub ,COUNT(*) FROM (st_subjects JOIN subjects USING (sub_id)) JOIN (st_sec JOIN sections USING(secid)) USING (stid)  WHERE teacher = '$id' AND st_subjects.ClEARED = 'NOT CLEARED' GROUP BY sub, section";
              $query2 = "SELECT section,club ,COUNT(*) FROM (st_clubs JOIN clubs on clid = club_id) JOIN (st_sec JOIN sections USING(secid)) USING (stid)  WHERE clubs.adviser = '$id' AND st_clubs.ClEARED = 'NOT CLEARED' GROUP BY club, section";
              $query3 = "SELECT section,des ,COUNT(*) FROM (st_non_teaching JOIN non_teaching USING (ot_id)) JOIN (st_sec JOIN sections USING(secid)) USING (stid)  WHERE signatant = '$id' AND st_non_teaching.ClEARED = 'NOT CLEARED' GROUP BY des, section";
              
              $result = mysql_query($query) or die (mysql_error());
              $count = mysql_num_rows($result);
              $count2 = 0;
              if($count!=0)
              {
               ?>
<br/>
<p>
<table id="table">
    <tr><th>Section</th><th>Subject</th><th>Number of Uncleared</th></tr>    
<?php
               while($val = mysql_fetch_row($result))
               {
                   $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
                   echo $tr;
                   echo "<td>$val[0]</td><td>$val[1]</td><td>$val[2]</td></tr>";
                   $count2++;
               }
               echo "</table>";
              }
              
              $result = mysql_query($query2) or die (mysql_error());
              $count = mysql_num_rows($result);
              $count2= 0;
              if($count!=0)
              {
               ?>
<table id="table">
<tr><th>Section</th><th>Club</th><th>Number of Uncleared</th></tr>    
<?php
               while($val = mysql_fetch_row($result))
               {
                   $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
                   echo $tr;
                   echo "<td>$val[0]</td><td>$val[1]</td><td>$val[2]</td></tr>";
                   $count2++;
               
                   
               }
               echo "</table>";
              }
              $result = mysql_query($query3) or die (mysql_error());
              $count = mysql_num_rows($result);
              
             
              $count2= 0;
              if($count!=0)
              {
               ?>
<table id="table">
    <tr><th>Section</th><th>Description</th><th>Number of Uncleared</th></tr>    
<?php
               while($val = mysql_fetch_row($result))
               {
                   $tr = ($count2%2==0)?'<tr>':'<tr class="alt">';
                   echo $tr;
                   echo "<td>$val[0]</td><td>$val[1]</td><td>$val[2]</td></tr>";
                   $count2++;
               }
               echo "</table>";
              }              
              
          }
          else //If user is an Administrator
              echo "<b>Note:</b> Change deadline in include\date.js";   
         echo "</p>";
          echo '</br>';
         
$clr->footer();
if(isset($_GET['allow']))
    echo '<script type="text/javascript">alert("You have no permission to access this page");</script>';


?>