<?php

require_once("../dompdf_config.inc.php");

if ( isset( $_POST["html"] )) {

  if ( get_magic_quotes_gpc() )
    $_POST["html"] = stripslashes($_POST["html"]);
  
  $dompdf = new DOMPDF();
  $dompdf->load_html($_POST["html"]);
  $dompdf->set_paper('letter', 'portrait');
  $dompdf->render();

  $dompdf->stream("clearance.pdf");
  header('location:../../download.php');
}

?>
<?php include("head.inc"); ?>

<a name="demo"> </a>
<h2>Demo</h2>


<p>Enter your html snippet in the text box below to see it rendered as a
PDF: (Note by default, remote stylesheets, images &amp; inline PHP are disabled.)</p>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
<p>Paper size and orientation:
<select name="paper">
<?php
foreach ( array_keys(CPDF_Adapter::$PAPER_SIZES) as $size )
  echo "<option ". ($size == "letter" ? "selected " : "" ) . "value=\"$size\">$size</option>\n";
?>
</select>
<select name="orientation">
  <option value="portrait">portrait</option>
  <option value="landscape">landscape</option>
</select>
</p>

<textarea name="html" cols="60" rows="20">
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
<center><img src='css/img/2.jpg' height='50px' width='50px'><br>Department of Science and Technology <br />
<b>PHILIPPINE SCIENCE HIGH SCHOOL - Ilocos Region Campus</b> <br/>
San Ildefonso, 2728 Ilocos Sur<br /></center>
<?php
        $connection = mysql_connect('localhost','root','');
        session_start();
        mysql_select_db('clearance');
        $id = $_SESSION['id'];
        $query = "SELECT lname, fname, mname,section,cont_num,address,students.yrlevel FROM students JOIN (st_sec JOIN sections USING (secid)) USING (stid) WHERE stid = $id";
        $st = mysql_fetch_row(mysql_query($query)) or die ("Error:" . mysql_error() ."<br /> Query: " . $query );
?>
<hr width="60%"/>
<br/>
<center>
<b>Name:</b> <?php echo "$st[0], $st[1] $st[2]"; ?> <br/>
<b>Year & Section:</b> <?php echo " $st[6]-$st[3]";?> <br/>
<b>Contact No:</b> <?php echo "$st[4]"; ?> <br/>
<b>Complete Address:</b> <?php echo "$st[5]"; ?> <br/><br />
   <?php
                        //Subjects
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
                        
                        //Clubs
                        $query = "SELECT club,cleared,DATE_FORMAT(date_signed,'%M %d, %Y %r') FROM clubs JOIN st_clubs ON (club_id = clid) WHERE stid = $id";
                         $sub = mysql_query($query) or die ("Error:" . mysql_error() ."<br /> Query: " . $query);
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

                        //Non - teaching
                        $query = "SELECT des,cleared,DATE_FORMAT(date_signed,'%M %d, %Y %r') FROM non_teaching JOIN st_non_teaching USING (ot_id) WHERE stid = $id";
                         $sub = mysql_query($query) or die ("Error:" . mysql_error() ."<br /> Query: " . $query);
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
			echo "</table></center>";
		?>
</center>
</textarea>

<div style="text-align: center; margin-top: 1em;">
  <button type="submit">Download</button>
</div>

</form>
<p style="font-size: 0.65em; text-align: center;">(Note: if you use a KHTML
based browser and are having difficulties loading the sample output, try
saving it to a file first.)</p>


<?php include("foot.inc"); ?>