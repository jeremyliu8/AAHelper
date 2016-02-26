<!DOCTYPE html>
<html>
<head>
	<title>testing</title>
</head>
<body>
	 <table style='border: solid 1px black;'>
	 	<tr> 
	 		<th>Student ID</th>
	 		<th>First Nameame</th>
	 		<th>Last Name</th>
	 	</tr>

	 	<?php 
	 		// Create a class that attaches table syntax to each select statement
			class TableRows extends RecursiveIteratorIterator {
				function __construct($it) {
					parent::__construct($it, self::LEAVES_ONLY);
				}

				function current() {
					return "<td style='width:150px;border:1px solid black;'>" . parent::current() . "</td>";
				}

				function beginChildren() {
					echo "<tr>";
				}

				function endChildren() {
					echo "</tr>" . "\n";
				}
			}

		 	$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "aahelper";

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				// SQL statement we want to execute
	 			$stmt = $conn->prepare("SELECT studentid, fname, lname FROM student");
	 			$stmt->execute();

	 			// print_r($stmt->fetchAll());

	 			//set the resulting array to associative
	 			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	 			// print_r($stmt->fetchAll());
	 			foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $key => $value) {
	 				echo $value;
	 			}
	 		}
	 		catch(PDOException $e) {
	 			echo "Error: " . $e->getMessage();
	 		}

	 		// Close the connection
			$conn = null;
	 	?>
	 </table>
</body>
</html>