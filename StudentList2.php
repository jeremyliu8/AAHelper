<link rel="stylesheet" href="css/bootstrap.css">
<?php

session_start();

require_once 'includes/db_connect.php';
require_once 'includes/functions.php';

if (!logged_in()) {
  header("location: index.php");
}


// studentid of selected student
$stunum = $_SESSION["studentid"];

//open database
$fulldb = mysql_connect('localhost', 'root', '');

mysql_select_db('aahelper', $fulldb);

$studentinfo = "SELECT * FROM student where studentid='$stunum'";

$studentstuff = mysql_query($studentinfo);

while ($row = mysql_fetch_object($studentstuff)) {
?>
<nav class="navbar navbar-default navbar-inverse">
  <div class="container-fluid"> 
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand">
      <?php 
      $studentmajor = $row->major;
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
        <?php	echo $row->fname;
        		echo " ";
				echo $row->lname; ?>
        </a></li>
        <li>&nbsp;</li>
        <li><a><?php echo $row->studentid; ?></a></li>
      </ul>
    </div>
  </div>
</nav>
<?php
}



//course history from studentcourse

$coursehistory = "SELECT * FROM studentcourse where studentid='$stunum'";

$result = mysql_query($coursehistory);

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

while ($row = mysql_fetch_object($result)) {
	?> <tr> <td> <?php
	echo $row->courseid;
	?> </td> <?php
	?> <td> <?php
	echo $row->grade;
	?> </td> <?php
	$tt = $row->termtaken;
	$ttyear = substr($tt, 0, 4);
	$ttterm = substr($tt, 4);
	?> <td> <?php
	if($ttterm == 1){
		echo "Spring";
	}
	elseif($ttterm == 3){
		echo "Summer";
	}
	elseif($ttterm == 7){
		echo "Fall";
	}
	?> </td> <?php
	?> <td> <?php
	echo $ttyear;
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
  mysql_close($fulldb);
?>

<!-- include footer -->
<center>
  <?php include 'footer.php'; ?>
</center>
