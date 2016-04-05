<link rel="stylesheet" href="css/bootstrap.css">
<?php
    session_start();
// studentid of selected student
$stunum = $_SESSION["studentid"];

//open database
require_once 'includes/db_connect.php';
require_once 'includes/functions.php';

if (!logged_in()) {
  header("Location: index.php");
}

$studentinfo = "SELECT * FROM student where studentid='$stunum'";

$studentstuff = $connection->query($studentinfo);

while ($row = $studentstuff->fetch_array()) {
?>
<nav class="navbar navbar-default navbar-inverse">
  <div class="container-fluid"> 
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand">
      <?php 
      $studentmajor = $row['major'];
      if($studentmajor == "CS"){
      	echo "Computer Science";
      }
      elseif($studentmajor == "CIS"){
      	echo "Computer Information Systems";
      }
       ?>
      </a></div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li> </li>
        <li> </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a>
        <?php	echo $row['fname'];
        		echo " ";
				echo $row['lname']; ?>
        </a></li>
        <li>&nbsp;</li>
        <li><a><?php echo $row['studentid']; ?></a></li>
      </ul>
    </div>
  </div>
</nav>
<?php
}



//course history from studentcourse

$coursehistory = "SELECT * FROM studentcourse where studentid='$stunum'";

$result = $connection->query($coursehistory);

//magic

?> 
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="jumbotron">
  		<div class="panel panel-default">
    <table class="table table-condensed table-bordered">
  	<tr>
	    <th>Course ID</th>
	    <th>Course Grade</th>
	    <th>Term Taken</th>
	    <th>Year Taken</th>
  	</tr>
<?php

while ($row = $result->fetch_array()) {
	?> <tr> <td> <?php
	echo $row['courseid'];
	?> </td> <?php
	?> <td> <?php
	echo $row['grade'];
	?> </td> <?php
	$termAndYear = $row['termtaken'];
	$yearTaken = substr($termAndYear, 0, 4);
	$termTaken = substr($termAndYear, 4);
	?> <td> <?php
	if($termTaken == 1){
		echo "Spring";
	}
	elseif($termTaken == 4){
		echo "Summer";
	}
	elseif($termTaken == 7){
		echo "Fall";
	}
	?> </td> <?php
	?> <td> <?php
	echo $yearTaken;
	?> </td> <?php
}

?> </tr>
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
