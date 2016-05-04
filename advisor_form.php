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
	<script type="text/javascript">
	function checkStatus(status, id) {
		if (status == " " || status == "C") {
			var currentClass = document.getElementById(id);
			var prereq = currentClass.dataset.prereqs;
		}
	}
	</script>
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
<nav class="navbar navbar-default navbar-custom">
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
    <div class="col-lg-12 col-md-12 col-xs-12">
      <div class="jumbotron">
	  		<div class="panel panel-default">
			    <table class="table-bordered">
			    <tr>
			    <?php 
			    	$startyear = $stustartyear; 
			    	$endyear = $stustartyear + 4;
			    	$termWeAreCurrentlyIn = getCurrentTerm($startyear, $endyear);
			    	$termCounter = 1;
			    ?>
				    <th colspan="3"></th>
				    <?php for($x = 0; $x < 5; $x++){ ?>
			    		<th colspan="3"><center><?php echo $startyear + $x ?></center></th>
			    	<?php } ?>
				    <th></th>
				</tr>
				  	<tr>
					    <th class="className table-title">Class Name</th>
					    <th class="table-title">ID</th>
					    <th class="table-title">units</th>
					    <?php for($x = 0; $x < 5; $x++){ ?>
						    <th <?php if ($termCounter == $termWeAreCurrentlyIn) { ?>
						    	style="border-left: 3px solid #757388; border-right: 3px solid #757388; border-top: 3px solid #757388; background-color: #757388; color: white;"<?php
						    } $termCounter++; ?> class="term-width">F</th>
						    <th <?php if ($termCounter == $termWeAreCurrentlyIn) { ?>
						    	style="border-left: 3px solid #757388; border-right: 3px solid #757388; border-top: 3px solid #757388; background-color: #757388; color: white;"<?php
						    } $termCounter++; ?> class="term-width">S</th>
						    <th <?php if ($termCounter == $termWeAreCurrentlyIn) { ?>
						    	style="border-left: 3px solid #757388; border-right: 3px solid #757388; border-top: 3px solid #757388; background-color: #757388; color: white;"<?php
						    } $termCounter++; ?> class="term-width"><i class="fa fa-sun-o"></i></th>
					    <?php } ?>
					    <th class="table-title">Grade</th>
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
					
					// While loop loops through every class for that major, populates it with prereqs and coreqs
					// Then checks to see if the specified student has taken any of these classes.
					$rowCounter = 0;
					while ($row = $result->fetch_array()) {

						// Check for course's pre-requisite classes
						$courseid = $row['courseid'];
						$prereqs = "";
						$checkPrereqSql = "	SELECT prereqid 
											FROM prereq 
											WHERE courseid = ?";

						$checkPrereqStmt = $connection->prepare($checkPrereqSql);
						$checkPrereqStmt->bind_param('s', $courseid);
						$checkPrereqStmt->execute();

						$prereqResult = $checkPrereqStmt->get_result();
						
						if ($prereqResult->num_rows > 0) {
        					while ($currentPrereq = $prereqResult->fetch_assoc()) {
        						$prereqs .= $currentPrereq['prereqid'] . " ";
        					}
        				}

        				$prereqs = trim($prereqs);

        				// Check for course's co-requisite classes
        				$coreqs = "";

        				$checkCoreqSql = "	SELECT coreqid 
											FROM coreq 
											WHERE courseid = ?";

						$checkCoreqStmt = $connection->prepare($checkCoreqSql);
						$checkCoreqStmt->bind_param('s', $courseid);
						$checkCoreqStmt->execute();

						$coreqResult = $checkCoreqStmt->get_result();
						
						if ($coreqResult->num_rows > 0) {
        					while ($currentCoreq = $coreqResult->fetch_assoc()) {
        						$coreqs .= $currentCoreq['coreqid'] . " ";
        					}
        				}

        				$coreqs = trim($coreqs);


        				// Check for courses that require this course to be taken first
        				$requirementFor = "";

        				$checkReqSql = "	SELECT courseid 
											FROM prereq 
											WHERE prereqid = ?";

						$checkReqStmt = $connection->prepare($checkReqSql);
						$checkReqStmt->bind_param('s', $courseid);
						$checkReqStmt->execute();

						$reqResult = $checkReqStmt->get_result();
						
						if ($reqResult->num_rows > 0) {
        					while ($currentReq = $reqResult->fetch_assoc()) {
        						$requirementFor .= $currentReq['courseid'] . " ";
        					}
        				}

        				$requirementFor = trim($requirementFor);

						//check if course has been taken
        				$courseIsTaken = FALSE;

						$grade = "";
						$findCourseTakenSql = " SELECT * 
												FROM ( 
													SELECT courseid, grade, termtaken, status 
													FROM studentcourse JOIN student 
													ON studentcourse.studentid = student.studentid 
													WHERE student.studentid = ?
												) AS courseHistory 
												WHERE courseid = ?";
						
						$courseTakenStmt = $connection->prepare($findCourseTakenSql);
						$courseTakenStmt->bind_param('ss', $studentid, $courseid);
						$courseTakenStmt->execute();

						$courseTaken = $courseTakenStmt->get_result();

						if($taken = $courseTaken->fetch_assoc()){
							$year = substr($taken['termtaken'], 0,4);
							$term = substr($taken['termtaken'], 4,1);
							$remain = $year - $stustartyear;
							$remain = $remain * 3;

							$termpos = 0;
							if ($term == 7){ // 7 represents Fall
								// Fall is in position 1
								$termpos = 1;
							} elseif ($term == 1){ // 1 Represents Spring
								// Spring is in position 2
								$termpos = 2;
							} elseif ($term == 4){ // 4 represents Summer
								// Summer is in position 3
								$termpos = 3;
							}

							//spaces form base (3)
							$takenspace = $remain + $termpos;

							$grade = $taken['grade'];
							$status = $taken['status'];
							$courseIsTaken = TRUE;
						}

						?>
						<tr id="<?php echo $courseid; ?>"
							data-prereqs="<?php if (!empty($prereqs)){ echo $prereqs; } ?>"
							data-coreqs="<?php if (!empty($coreqs)){ echo $coreqs; } ?>"
							data-requirementfor="<?php if (!empty($requirementFor)){ echo $requirementFor; } ?>" >
							<td class="className table-title" 
								style="<?php if (!$courseIsTaken) { echo 'background-color:#ffff76'; } ?>" > <?php echo $row['classname']; ?> </td>
							<td class="table-title"> <?php echo $row['courseid']; ?> </td> 
							<td class="table-title"> <?php echo $row['units']; ?> </td> 
							<?php
								//break up terms
								$termnum = $row['term'];
								$fall = substr($termnum, 0,1);
								$spring = substr($termnum, 1,1);
								$summer = substr($termnum, 2,1);


							$termList = array($fall, $spring, $summer);
							$counter = 0;

							for ($i=1; $i <= 15; $i++) {
								// Give each button an individual id
								$buttonId = $row['courseid'] . "-" . $i;
								
								// Find the current status of the course
								$currentStatus = validate_term($termList[$counter], $takenspace, $i);

								if ($currentStatus == "closed") { ?>
									<td <?php if ($i == $termWeAreCurrentlyIn) { ?>
											style="background-color:#A5989F; border-left: 3px solid #757388; border-right: 3px solid #757388;"
										<?php } else { ?> 
											style="background-color:#A5989F;"
										<?php } ?> >
									</td> <?php
								} else { ?>
									<td id="<?php echo $buttonId; ?>" 
										<?php if ($i == $termWeAreCurrentlyIn) {
												if ($rowCounter == $result->num_rows - 1) { ?>
													style="border-left: 3px solid #757388; border-right: 3px solid #757388; border-bottom: 3px solid #757388;"
												<?php } else { ?>
													style="border-left: 3px solid #757388; border-right: 3px solid #757388;"
												<?php } 
										} ?> >
										<select class="selectpicker"
												data-width="100%" 
												title=" "
												onchange="checkStatus(this.value, <?php echo $courseid; ?>)"
												<?php if ($courseIsTaken && $currentStatus == "available") {
													echo "disabled"; 
												} ?> >
											<option title="C" <?php if ($currentStatus == "taken") { echo "selected='selected'"; } ?> >Completed</option>
											<option title="IP">In Progress</option>
											<option title="P">Planned</option>
											<option title="F">Failed</option>
											<option title="">Unselect</option>
										</select>
									</td> <?php 
								}

								// Cycle through the terms
								$counter++;
								if ($counter == 3) {
									$counter = 0;
								}
							}

							$takenspace = null; ?>
							<!-- end replication -->

							<td><input type="text" name="cs" size="3" maxlength="2" value="<?php echo $grade; ?>"></td> 
						</tr> 
						<?php
						$rowCounter++;
					} // End of row, loop through again until end of table! ?>
					</table>
				</div>
				<center><a class="link" href="advisor_home.php">Take Me Back!</a></center>
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
