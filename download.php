<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Download Clearance','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Download Clearance', $_SERVER['PHP_SELF'], 1);
$trail->output();
require_once("dompdf/dompdf_config.inc.php");

?>
<h1>Download Clearance</h1>
<iframe id='table' src="clearance4.php" frameborder="1" marginheight="10" marginwidth="10" width="650px" height="400px">
 <!--Preview of User's Printable Clearance-->
</iframe>
<form action="dompdf/www/demo.php" method="post">

<!--Start of code sent for conversion to PDF file-->
<textarea name="html" cols="0" rows="0" style="display:none">
<!--
This is the base HTML file for the PDF file of the printable clearance
-->

<style type="text/css">
    body
    {
        font-size: 12px;
    }
	
#table
{
position:relative;
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
border-collapse:collapse;
width:100%;
box-shadow: 0px 0px 10px #888888;
-webkit-box-shadow: 0px 0px 10px #888888;
}

#table td, #table th 
{
font-size:10px;
border:1px solid #000;
padding:3px 7px 2px 7px;
background-color:#fff;
}
#table th 
{
font-size:12px;
text-align:left;
padding-top:5px;
padding-bottom:4px;
background-color:#888;
color:#ffffff;
}
</style>
<center><img src='../../css/img/2.jpg' height='50px' width='50px'><br>Department of Science and Technology <br />
<b>PHILIPPINE SCIENCE HIGH SCHOOL - Ilocos Region Campus</b> <br/>
San Ildefonso, 2728 Ilocos Sur<br /></center>
<?php
        $connection = mysql_connect('localhost','root','');
        mysql_select_db('clearance');
        
        $id = $_SESSION['id']; //GETS the student ID of current user
        
        //Extracts the Student Information
        $query = "SELECT lname, fname, mname,section,cont_num,address,students.yrlevel FROM students JOIN (st_sec JOIN sections USING (secid)) USING (stid) WHERE stid = $id";
        
        $st = mysql_fetch_row(mysql_query($query)) or die ("Error:" . mysql_error() ."<br /> Query: " . $query );
?>
<!--Formating of clearance starts-->
<hr width="60%"/>
<br/>
<center>
<b>Name:</b> <?php echo "$st[0], $st[1] $st[2]"; ?> <br/>
<b>Year & Section:</b> <?php echo " $st[6]-$st[3]";?> <br/>
<b>Contact No:</b> <?php echo "$st[4]"; ?> <br/>
<b>Complete Address:</b> <?php echo "$st[5]"; ?> <br/><br />
   <?php
                        // GETS the Subjects Clearance data
                        $query = "SELECT sub,cleared,DATE_FORMAT(date_signed,'%M %d, %Y %r') FROM subjects JOIN st_subjects USING (sub_id) WHERE stid = $id";
                         $sub = mysql_query($query) or die ("Error:" . mysql_error ."<br /> Query: " . $query);
			echo "<center><table id='table'><tr><th><b>Subjects</th><th>Cleared</th><th>Date</th></tr>";
			while ($row = mysql_fetch_row($sub))
			{
				$val = "<tr><td width='200px'><b>$row[0]</b></td><td align='center' width='100px'>";
				if($row[1]=='CLEARED')
					$val.= "<div width='10px' height='50px' style='background-color:green; color:white;'>Cleared</div>";
				else
					$val.= "<div width='10%' height='50px' style='background-color:red; color:white;'>Not Cleared</div>";
				$val.="</td><td>$row[2]</td></tr>";
							echo $val;
			}
			echo "</table></center><br>";
                        
                         // GETS the Clubs Clearance data
                        $query = "SELECT club,cleared,DATE_FORMAT(date_signed,'%M %d, %Y %r') FROM clubs JOIN st_clubs ON (club_id = clid) WHERE stid = $id";
                         $sub = mysql_query($query) or die ("Error:" . mysql_error() ."<br /> Query: " . $query);
			echo "<center><table id='table'><tr><th><b>Clubs</th><th>Cleared</th><th>Date</th></tr>";
			while ($row = mysql_fetch_row($sub))
			{
				$val = "<tr><td width='200px'><b>$row[0]</b></td><td align='center' width='100px'>";
				if($row[1]=='CLEARED')
					$val.= "<div width='10px' height='50px' style='background-color:green; color:white;'>Cleared</div>";
				else
					$val.= "<div width='10%' height='50px' style='background-color:red; color:white;'>Not Cleared</div>";
				$val.="</td><td>$row[2]</td></tr>";
							echo $val;
			}
			echo "</table></center><br>";

                        // GETS the Non-teaching Clearance data
                        $query = "SELECT des,cleared,DATE_FORMAT(date_signed,'%M %d, %Y %r') FROM non_teaching JOIN st_non_teaching USING (ot_id) WHERE stid = $id AND NOT des = 'Campus Director' AND NOT des = 'CISD Chief'";
                         $sub = mysql_query($query) or die ("Error:" . mysql_error() ."<br /> Query: " . $query);
			echo "<center><table id='table'><tr><th><b>Non-teaching</th><th>Cleared</th><th>Date</th></tr>";
			while ($row = mysql_fetch_row($sub))
			{
				$val = "<tr><td width='200px'><b>$row[0]</b></td><td align='center' width='100px'>";
				if($row[1]=='CLEARED')
					$val.= "<div width='10px' height='50px' style='background-color:green; color:white;'>Cleared</div>";
				else
					$val.= "<div width='10%' height='50px' style='background-color:red; color:white;'>Not Cleared</div>";
				$val.="</td><td>$row[2]</td></tr>";
							echo $val;
			}
			echo "</table></center> <br>";
                        
                         // GETS the Recommendation for Approval From CISD Chief
                         $query = "SELECT des,cleared,DATE_FORMAT(date_signed,'%M %d, %Y %r') FROM non_teaching JOIN st_non_teaching USING (ot_id) WHERE stid = $id AND des = 'CISD Chief' ORDER BY des ASC";
                         $sub = mysql_query($query) or die ("Error:" . mysql_error() ."<br /> Query: " . $query);
                         while ($row = mysql_fetch_row($sub))
			{
                                echo "<center><table id='table'><tr><th>Recommended for Approval By</th><th>Cleared</th><th>Date</th></tr>";
				$val = "<tr><td width='200px'><b>$row[0]</b></td><td align='center' width='100px'>";
				if($row[1]=='CLEARED')
					$val.= "<div width='10px' height='50px' style='background-color:green; color:white;'>Recommened</div>";
				else
					$val.= "<div width='10%' height='50px' style='background-color:red; color:white;'>Not Recommended</div>";
				$val.="</td><td>$row[2]</td></tr>";
							echo $val;
			}
			echo "</table></center>";
                        
                        // GETS the Approval of the Campus Director
                         $query = "SELECT des,cleared,DATE_FORMAT(date_signed,'%M %d, %Y %r') FROM non_teaching JOIN st_non_teaching USING (ot_id) WHERE stid = $id AND des = 'Campus Director' ORDER BY des ASC";
                         $sub = mysql_query($query) or die ("Error:" . mysql_error() ."<br /> Query: " . $query);
                         while ($row = mysql_fetch_row($sub))
			{
                                echo "<center><table id='table'><tr><th>Approved By</th><th>Cleared</th><th>Date</th></tr>";
				$val = "<tr><td width='200px'><b>$row[0]</b></td><td align='center' width='100px'>";
				if($row[1]=='CLEARED')
					$val.= "<div width='10px' height='50px' style='background-color:green; color:white;'>Approved</div>";
				else
					$val.= "<div width='10%' height='50px' style='background-color:red; color:white;'>Not Approved</div>";
				$val.="</td><td>$row[2]</td></tr>";
							echo $val;
			}
			echo "</table></center>";
		?>
</center>
<!--Formating of clearance ends-->
</textarea>
    <!--End of code sent for conversion to PDF file-->
    
    <br/>
    <input type="submit" value="Download"/>
</form>
<?php
$clr->footer();
?>
