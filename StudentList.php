<!DOCTYPE html>
<html>
<body>
	<?php 

	$fulldb = mysql_connect('localhost', 'root', '');

	mysql_select_db('aahelper', $fulldb);

	$students = "SELECT fname, lname, studentid 
					FROM student";

	$result = mysql_query($students);

	$numRows = mysql_num_rows($result); 
	echo "<h1>" . $numRows . " Student" . ($numRows == 1 ? "" : "s") . " Available </h1>"; 

	//display all students so advisor can pick a student and then
	// their studentid will be passed on
	?>
	<form action = "StudentList2.php" method = "post">
	<table style="width=300">
	<?php
	while($row = mysql_fetch_array($result))
	{
	?>
	<tr>
		<td>
		  <input type="radio" name="studentnum" value="<?php echo $row["studentid"] ?>" ><br>
		</td>
		<td>
			<?php
			  echo $row["fname"] . " " . $row["lname"];
			?>
		</td>
	</tr>
	<?php
	}

	mysql_close($fulldb);
	?>
	</table>
	<input type="submit" name="submit" value="Submit"> 
	</form>

</body>
</html>