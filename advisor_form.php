<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Form</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="js/bootstrap-select.js"></script>
</head>
<?php 
	session_start();

	//open database
	require_once 'includes/db_connect.php';
	require_once 'includes/functions.php';

	if (!logged_in()) {
  		header("Location: index.php");
	}

	//use this 
	$studentid = $_GET['studentid'];

	$sql_student = "SELECT * 
					FROM student
					WHERE studentid='$studentid'";

	$result = $connection->query($sql_student);

	$stufname = null;
	$stulname = null;
	$stumajor = null;
	$stustartyear = null;

	while($row = $result->fetch_array()){
	$stufname = $row['fname'];
	$stulname = $row['lname'];
	$stumajor = $row['major'];
	$stustartyear = $row['startyear'];
	}


	//write_to_file($_SESSION, "Session Variables");

	$studentMajor = $stumajor;
	if ($studentMajor == 'CS') {
		$studentMajor = "Computer Science";
	}
	elseif ($studentMajor == 'CIS') {
		$studentMajor = "Computer Information Systems";
	}

	//write_to_file($studentMajor, "\$studentMajor");

?>
<body>
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
	        	echo $stufname;
	        	echo " ";
				echo $stulname; 
			?>
	      </a></li>
	      <li>&nbsp;</li>
        <li><a><?php echo $studentid; ?></a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- the table -->
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="jumbotron">
	  		<div class="panel panel-default">
			    <table class="table-bordered">
			    <tr>
			    <?php $startyear = $stustartyear; ?>
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
					$sql_coursemajor->bind_param('s', $stumajor);
					$sql_coursemajor->execute();

					$result = $sql_coursemajor->get_result();

					//takes every courseid with correct major

					$takenspace = null;
					
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
						$courseTakenStmt->bind_param('ss', $studentid, $courseid);
						$courseTakenStmt->execute();

						$courseTaken = $courseTakenStmt->get_result();

						if($taken = $courseTaken->fetch_assoc()){
							//write_to_file($taken, "\$taken");
							$year = substr($taken['termtaken'], 0,4);
							$term = substr($taken['termtaken'], 4,1);
							//years off start date (0 = start year)
							$remain = $year - $stustartyear;
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


							$currentTerm = "fall";
							for ($i=1; $i <= 15; $i++) { 
								switch ($currentTerm) {
									case "fall":
										if (validate_term($fall, $takenspace, $i) == "taken") {
											?><td>
												<select class="selectpicker" data-width="100%" title=" ">
													<option title="C" selected="selected">Completed</option>
													<option title="IP">In Progress</option>
													<option title="P">Planned</option>
													<option title="F">Failed</option>
													<option title="">Unselect</option>
												</select>
											</td><?php
										} elseif (validate_term($fall, $takenspace, $i) == "available") {
											?><td>
												<select class="selectpicker" data-width="100%" title=" ">
													<option title="C">Completed</option>
													<option title="IP">In Progress</option>
													<option title="P">Planned</option>
													<option title="F">Failed</option>
													<option title="">Unselect</option>
												</select>
											</td><?php
										} else {
											?><td style="background-color:black;"></td><?php
										}
										break;
									case "spring":
										if (validate_term($spring, $takenspace, $i) == "taken") {
											?><td>
												<select class="selectpicker" data-width="100%" title=" ">
													<option title="C" selected="selected">Completed</option>
													<option title="IP">In Progress</option>
													<option title="P">Planned</option>
													<option title="F">Failed</option>
													<option title="">Unselect</option>
												</select>
											</td><?php
										} elseif (validate_term($spring, $takenspace, $i) == "available") {
											?><td>
												<select class="selectpicker" data-width="100%" title=" ">
													<option title="C">Completed</option>
													<option title="IP">In Progress</option>
													<option title="P">Planned</option>
													<option title="F">Failed</option>
													<option title="">Unselect</option>
												</select>
											</td><?php
										} else {
											?><td style="background-color:black;"></td><?php
										}
										break;
									case "summer":
										if (validate_term($summer, $takenspace, $i) == "taken") {
											?><td>
												<select class="selectpicker" data-width="100%" title=" ">
													<option title="C" selected="selected">Completed</option>
													<option title="IP">In Progress</option>
													<option title="P">Planned</option>
													<option title="F">Failed</option>
													<option title="">Unselect</option>
												</select>
											</td><?php
										} elseif (validate_term($summer, $takenspace, $i) == "available") {
											?><td>
												<select class="selectpicker" data-width="100%" title=" ">
													<option title="C">Completed</option>
													<option title="IP">In Progress</option>
													<option title="P">Planned</option>
													<option title="F">Failed</option>
													<option title="">Unselect</option>
												</select>
											</td><?php
										} else {
											?><td style="background-color:black;"></td><?php
										}
										break;
								}

								// Cycle through the terms
								if ($currentTerm == "fall") {
									$currentTerm = "spring";
								} elseif ($currentTerm == "spring") {
									$currentTerm = "summer";
								} elseif ($currentTerm == "summer") {
									$currentTerm = "fall";
								}
							}

							$takenspace = null; ?>
							<!-- end replication -->

							<td><input type="text" name="cs" size="3" maxlength="2" value="<?php echo $grade; ?>"></td> 
						</tr> 
						<?php
					} // End of row, loop through again until end of table! ?>
					</table>
				</div>
				<center><a href="advisor_home.php">Take Me Back!</a></center>
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