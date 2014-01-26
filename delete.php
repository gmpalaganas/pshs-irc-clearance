	<?php
			$connect = mysql_connect('localhost','root','') or die ("Unable to Connect!");
			mysql_select_db('clearance') or die ("Unable to Select Database");
                        
			$table= ' ';
			$head = ' ';
			$id = ' ';
                        
                        /* Checks if being cleared is a subject, a non-teaching, a club, or a section
                         * $table refers to what table in the database is to be UPDATED
                         * $head refers to filename of the page where the user is redirected after instructions are finished
                         * $id refers to the fieldname of the ID number of the entity being cleared
                         */
                        
			if(isset($_POST['students']))
			{
				$table= 'students';
				$head = 'students';
				$id= 'stid';
			}
			if(isset($_POST['non_teaching']))
			{
				$table= 'non_teaching';
				$head = 'non_teaching';
				$id = 'ot_id';
			}
			if(isset($_POST['subject']))
			{
				$table= 'subjects';
				$head = 'subjects_li';
				$id = 'sub_id';
			}
			if(isset($_POST['clubs']))
			{
				$table= 'clubs';
				$head = 'clubs_li';
				$id = 'club_id';
			}
			$query = "DELETE FROM $table WHERE $id= ";
			echo $query;
			$delete = $_POST['delete'];
			echo $delete[0];
                        
                        //Delete selected
			for($count=0;$count<sizeof($delete);$count++)
				$result = mysql_query($query. $delete[$count]) or die ('Error in query: $query.' . mysql_error());
			header("location:$head.php");
		?>
