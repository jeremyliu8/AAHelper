<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<?php 
	session_start();

	//open database
	require_once 'includes/db_connect.php';
	require_once 'includes/functions.php';

	if (!logged_in()) {
  		header("Location: index.php");
	}

	//write_to_file($_SESSION, "Session Variables");

	$studentMajor = $_SESSION['major'];
	if ($studentMajor == 'CS') {
		$studentMajor = "Computer Science";
	}
	elseif ($studentMajor == 'CIS') {
		$studentMajor = "Computer Information Systems";
	}

	//write_to_file($studentMajor, "\$studentMajor");

?>
<nav class="navbar navbar-default navbar-inverse">
  <div class="container-fluid"> 
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"></button>
      <a class="navbar-brand"> <?php echo $studentMajor; ?> </a>
    </div>
	  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	    <ul class="nav navbar-nav">
          <li> </li>
          <li> </li>
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	      <li><a class="text-primary">
	        <?php	
	        	echo $_SESSION['fname'];
	        	echo " ";
				echo $_SESSION['lname']; 
			?>
	      </a></li>
	      <li>&nbsp;</li>
        <li><a><?php echo $_SESSION['studentid']; ?></a></li>
      </ul>
    </div>
  </div>
</nav>

<body background="img/sunset.jpg">
<!-- the table -->
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="jumbotron">
	  		<div class="panel panel-default">
			    <table class="table table-condensed table-bordered">
			    <tr>
			    <?php $startyear = $_SESSION['startyear']; ?>
				    <th colspan="3"></th>
				    <?php for($x = 0; $x < 5; $x++){ ?>
			    	<th colspan="3"><center><?php echo $startyear + $x ?></center></th>
			    	<?php } ?>
				    <th></th>
				</tr>
				  	<tr>
					    <th>Class Name</th>
					    <th>Course ID</th>
					    <th>units</th>
					    <?php for($x = 0; $x < 5; $x++){ ?>
						    <th>F</th>
						    <th>S</th>
						    <th><i class="fa fa-sun-o"></i></th>
					    <?php } ?>
					    <th>Course Grade</th>
				  	</tr>

					<?php

					$sql_coursemajor = "SELECT * 
						FROM courses JOIN major 
						ON courses.courseid = major.courseid 
						WHERE majorid = ?;";

					$sql_coursemajor = $connection->prepare($sql_coursemajor);
					$sql_coursemajor->bind_param('s', $_SESSION['major']);
					$sql_coursemajor->execute();

					$result = $sql_coursemajor->get_result();

					//takes every courseid with correct major
					while ($row = $result->fetch_array()) {

						//check if course has been taken
						$grade = "";
						$courseid = $row['courseid'];
						$findCourseTakenSql = " SELECT * 
												FROM ( 
													SELECT courseid, grade, termtaken, status 
													FROM studentcourse JOIN student 
													ON studentcourse.studentid = student.studentid 
													where student.studentid = ?
												) as courseHistory 
												where courseid = ?";
						
						$courseTakenStmt = $connection->prepare($findCourseTakenSql);
						$courseTakenStmt->bind_param('ss', $_SESSION['studentid'], $courseid);
						$courseTakenStmt->execute();

						$courseTaken = $courseTakenStmt->get_result();

						if($taken = $courseTaken->fetch_assoc()){
							//write_to_file($taken, "\$taken");
							$year = substr($taken['termtaken'], 0,4);
							$term = substr($taken['termtaken'], 4,1);
							//years off start date (0 = start year)
							$remain = $year - $_SESSION['startyear'];
							$remain = $remain * 3;

							$termpos = 0;
							if ($term == 7){
								// 7 represents Fall
								// Fall is in position 1
								$termpos = 1;
							} elseif ($term == 1){
								// 1 Represents Spring
								// Spring is in position 2
								$termpos = 2;
							} elseif ($term == 4){
								// 4 represents Summer
								// Summer is in position 3
								$termpos = 3;
							}

							//spaces form base (3)
							$takenspace = $remain + $termpos;

							$grade = $taken['grade'];
						}

						?>
						<tr> 
							<td> <?php echo $row['classname']; ?> </td>
							<td> <?php echo $row['courseid']; ?> </td> 
							<td> <?php echo $row['units']; ?> </td> 
							<?php
								//break up terms
								$termnum = $row['term'];
								$fall = substr($termnum, 0,1);
								$spring = substr($termnum, 1,1);
								$summer = substr($termnum, 2,1);


							//replicate for all 5 years
							//for($x = 0; $x < 5; $x++){ ?>
							<td <?php echo validate_term($fall, $takenspace, 1); ?> ></td>
							<td <?php echo validate_term($spring, $takenspace, 2); ?> ></td>
							<td <?php echo validate_term($summer, $takenspace, 3); ?> ></td>
							<td <?php echo validate_term($fall, $takenspace, 4); ?> ></td>
							<td <?php echo validate_term($spring, $takenspace, 5); ?> ></td>
							<td <?php echo validate_term($summer, $takenspace, 6); ?> ></td>
							<td <?php echo validate_term($fall, $takenspace, 7); ?> ></td>
							<td <?php echo validate_term($spring, $takenspace, 8); ?> ></td>
							<td <?php echo validate_term($summer, $takenspace, 9); ?> ></td>
							<td <?php echo validate_term($fall, $takenspace, 10); ?> ></td>
							<td <?php echo validate_term($spring, $takenspace, 11); ?> ></td>
							<td <?php echo validate_term($summer, $takenspace, 12); ?> ></td>
							<td <?php echo validate_term($fall, $takenspace, 13); ?> ></td>
							<td <?php echo validate_term($spring, $takenspace, 14); ?> ></td>
							<td <?php echo validate_term($summer, $takenspace, 15); ?> ></td>
							<?php $takenspace = null;// } ?>
							<!-- end replication -->

							<td> <?php echo $grade; ?> </td> 
						</tr> 
						<?php
					} // End of row, loop through again until end of table! ?>
					</table>
				</div>
				<center><a href="includes/logout.php">Logout</a></center>
	  	</div>
	</div>
  </div>
</div> 

<?php
  $connection->close();
?>

<!-- include footer -->
<center>
  <?php include 'footer.php'; ?>
</center>
</body>
</html>
