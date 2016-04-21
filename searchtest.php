<!DOCTYPE html> 
	<html> 
	  <head> 
	    <meta  http-equiv="Content-Type" content="text/html;  charset=iso-8859-1"> 
	    <title>Search Students</title> 

	    <link rel="stylesheet" href="css/bootstrap.css">


	    <!-- <script src="js/jquery-1.11.2.min.js"></script> -->
	    <script   src="https://code.jquery.com/jquery-1.12.3.js"   integrity="sha256-1XMpEtA4eKXNNpXcJ1pmMPs8JV+nwLdEqwiJeCQEkyc="   crossorigin="anonymous"></script>
	    <script src="js/jquery.searchable-1.1.0.min.js"></script>
	    <script src="js/searchable.js"></script>
	  </head> 
	  <body> 
	    <h3>Search Students</h3> 
	    <p>You  may search by first name, last name, major, and student id</p> 
	    <!-- <form method="get" action="<?php // echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  id="searchform"> 
	      <input  type="text" search="search"> 
	      <input  type="submit" search="submit" value="Search"> 
	    </form>  -->



		<div class="container">    
		    <div class="row">
		        <div class="col-lg-4 col-lg-offset-4">
		            <input type="search" id="search" value="" class="form-control" placeholder="Search using Fuzzy searching">
		        </div>
		    </div>
		    <div class="row">
		    	<div class="col-md-12">
				    <table id="studentList" class="table">
					    <thead>	
					    	<tr>
					    		<th>Student ID</th>
					    		<th>First Name</th>
					    		<th>Last Name</th>
					    		<th>major</th>
					    	</tr>
					    </thead>
				    	<tbody>
					    	<tr>
					    		<td>000</td>
					    		<td>Jeremy</td>
					    		<td>Liu</td>
					    		<td>CS</td>
					    	</tr>
					    	<tr>
					    		<td>001</td>
					    		<td>Daniel</td>
					    		<td>Nishijima</td>
					    		<td>CS</td>
					    	</tr>
					    	<tr>
					    		<td>002</td>
					    		<td>Chris</td>
					    		<td>Sissoyev</td>
					    		<td>CIS</td>
					    	</tr>
					    </tbody>
				    </table>
				</div>
		    </div>
		</div>

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





// if($_SERVER["REQUEST_METHOD"] == "GET"){
// 	$search = $_GET['search'];
// 	$array = "SELECT fname, lname, studentid, major 
// 			  WHERE fname LIKE '%?%' OR lname LIKE '%?%' OR studentid LIKE '%?%'";
	
// 	$preparedStatement = $connection->prepare($array);
// 	$preparedStatement->bind_param('sss', $search, $search, $search);
// 	$preparedStatement->execute();

// 	while($row = $result->fetch_assoc()){ 
//      	$fname = $row['fname']; 
//      	$lname = $row['lname']; 
//      	$studentid = $row['studentid'];
//      	$major = $row['major'];

// 		echo  "<ul>\n"; 
// 		echo  "<li>" . $fname . " " . $lname .  "</li>\n"; 
// 		echo  "<li>" . $studentid . "</li>\n"; 
// 		echo  "<li>" . $major . "</li>\n"; 
// 		echo  "</ul>"; 
// 	}
// }

?>


</body> 
</html> 