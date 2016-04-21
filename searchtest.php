<!DOCTYPE html> 
	<html> 
	  <head> 
	    <meta  http-equiv="Content-Type" content="text/html;  charset=iso-8859-1"> 
	    <title>Search Students</title> 
	  </head> 
	  <body> 
	    <h3>Search Students</h3> 
	    <p>You  may search by first name, last name, major, email, and student id</p> 
	    <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  id="searchform"> 
	      <input  type="text" search="search"> 
	      <input  type="submit" search="submit" value="Search"> 
	    </form> 

<?php

/**
* login function
* 
* This function attempts to login the user
* 
* @params = mysqli object
* returns = boolean (true if connected, false if not)
*/

require_once 'includes/functions.php';
require_once 'includes/db_connect.php';


if($_SERVER["REQUEST_METHOD"] == "GET"){
	$search = $_GET['search'];
	$array = "SELECT fname, lname, studentid, major 
			  WHERE fname LIKE '%?%' OR lname LIKE '%?%' OR studentid LIKE '%?%'";
	
	$preparedStatement = $connection->prepare($array);
	$preparedStatement->bind_param('sss', $search, $search, $search);
	$preparedStatement->execute();

	while($row = $result->fetch_assoc()){ 
     	$fname = $row['fname']; 
     	$lname = $row['lname']; 
     	$studentid = $row['studentid'];
     	$major = $row['major'];

		echo  "<ul>\n"; 
		echo  "<li>" . $fname . " " . $lname .  "</li>\n"; 
		echo  "<li>" . $studentid . "</li>\n"; 
		echo  "<li>" . $major . "</li>\n"; 
		echo  "</ul>"; 
	}
}

?>


</body> 
</html> 