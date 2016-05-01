<!DOCTYPE html>
<html>
<body>
	<?php 

	//open database
	require_once 'includes/db_connect.php';
	require_once 'includes/functions.php';

	$students = "SELECT fname, lname, studentid 
					FROM student";

	$result = $connection->query($students);

	$numRows = $result->num_rows; 
	echo "<h1>" . $numRows . " Student" . ($numRows == 1 ? "" : "s") . " Available </h1>"; 

	//display all students so advisor can pick a student and then
	// their studentid will be passed on
	?>
	<form action = "StudentList2.php" method = "post">
	<table style="width=300">
	<?php
	while($row = $result->fetch_array())
	{
	?>
	<tr>
		<td>
		  <input type="radio" name="studentnum" value="<?php echo $row['studentid'] ?>" ><br>
		</td>
		<td>
			<?php
			  echo $row['fname'] . " " . $row['lname'];
			?>
		</td>
	</tr>
	<?php
	}

  	$connection->close();
	?>
	</table>
	<input type="submit" name="submit" value="Submit"> 
	</form>

</body>
</html>
