<?php
include('include/clearance.php'); //Invoke PHP file containing clearance class which contains header and footer functions
$clr = new Clearance('Change Password','');
$clr->header();
include("breadcrumbs.php");  //Invoke PHP file for breadcrumbs
$trail = new Breadcrumb();
$trail->add('Change Password', $_SERVER['PHP_SELF'], 1);
$trail->output();
			if(isset($_GET['fail']))
				echo '<script type="text/javascript">alert("Wrong Old Password or Password not match");</script>';
		?>
		<p><h1>Change Password</h1></p>
		<form action="pword.php" method="post">
		<div class="data">
		<label for="old_pword">Old Password </label><input type="password" name="old_pword"><br>
		<label for="n_pword">New Password</label><input type="password" name="n_pword"><br>
		<label for="rn_pword">Retype New Password</label> <input type="password" name="rn_pword"><br>
		<input type="submit" value="change">
		</div>
		</form>
		</div>
		</td>
		</tr>
		 </table> <?php
$clr->footer();
?>