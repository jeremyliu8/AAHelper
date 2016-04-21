<!DOCTYPE html> 
	<html> 
	  <head> 
	    <meta  http-equiv="Content-Type" content="text/html;  charset=iso-8859-1"> 
	    <title>Search Students</title> 

	    <link rel="stylesheet" href="css/bootstrap.css">

	    <script   src="https://code.jquery.com/jquery-1.12.3.js"   integrity="sha256-1XMpEtA4eKXNNpXcJ1pmMPs8JV+nwLdEqwiJeCQEkyc="   crossorigin="anonymous"></script>
	    <script src="js/jquery.searchable-1.1.0.min.js"></script>
	    <script src="js/searchable.js"></script>
	  </head> 
	  <body> 
	    <h3>Search Students</h3> 
	    <p>You  may search by first name, last name, major, and student id</p> 

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
				    		<?php
								require_once 'includes/functions.php';
								require_once 'includes/db_connect.php';

								$array = "SELECT * 
										 FROM student";
								$result = $connection->query($array);

								if ($result->num_rows > 0) {
								    while ($row = $result->fetch_assoc()) {
								        $fname = $row['fname'];
								        $lname = $row['lname'];
								        $studentid = $row['studentid'];
								        $major = $row['major'];
								        echo "<tr>";
								        echo "<td><a href=advisorform.php?studentid=",urlencode($studentid),">$studentid</a></td>";
								        echo "<td>$fname</td>";
								        echo "<td>$lname</td>";
								        echo "<td>$major</td>";
								        echo "</tr>";
								    }
								}
								$connection->close();
							?>
					    </tbody>
				    </table>
				</div>
		    </div>
		</div>




</body> 
</html> 