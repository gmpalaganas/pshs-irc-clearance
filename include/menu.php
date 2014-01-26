<?php
/*
 * Menu Class
 * Developer: Genesis Ian M. Palaganas
 * 
 * This class is for the Contracting-Expanding Menu
 * of the PSHS-IRC Online Clearance wherein
 * the user can click an item (referred to as parents) of the menu to reveal
 * its subitems (referred to as children).
 */
class Menu{
	function add_item($parent,$child)
	{
		?>
		<script language="Javascript" src="jquery.js"></script>
		<script language="Javascript">
			$(document).ready(function(){						
		<?php
			foreach($child as $val){ //Set the properties of the children
				echo "document.getElementById('$val').style.display = 'none';";
				echo "document.getElementById('$val').style.color = '#003';";
			}
			foreach($parent as $val){ //Set the properties of the parents
				echo "document.getElementById('$val').style.color = '#003';";
				echo "document.getElementById('$val').style.cursor = 'pointer';";
			}		


		for($x=0;$x<sizeof($parent);$x++){ //Makes the Children Appear/Disappear whenever the parent is clicked
				$a = "#".$parent[$x];
				$b= "#".$child[$x];
				echo "$('$a').click(function(){
    			$('$b').slideToggle('slow');
  				});";
		}
		?>
  			});
		</script>
	<?php
	}
}	

?>