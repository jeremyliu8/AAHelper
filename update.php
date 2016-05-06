<!DOCTYPE html>
<html>
<head>

<?php
require_once 'includes/db_connect.php';

//In Progress
$status = $_GET['s'];

if($status == 'Completed'){
$status='C';
}
elseif($status == 'In Progress'){
$status='IP';
}
elseif($status == 'Planned'){
$status='P';
}
elseif($status == 'Failed'){
$status='F';
}
elseif($status == 'Unselected'){
$status=null;
}


//CS220-2
$id = $_GET['i'];
list($courseid,$term)= explode('-', $id);
$term--;

//002352690
$studentid = $_GET['st'];

//2012
$srtyear = $_GET['y'];

$yterm = intval($term/3);
$tterm = $term%3;

if($yterm==0){
	$srtyear = $srtyear;
}
elseif($yterm==1){
	$srtyear = $srtyear+1;
}
elseif($yterm==2){
	$srtyear = $srtyear+2;
}
elseif($yterm==3){
	$srtyear = $srtyear+3;
}
elseif($yterm==4){
	$srtyear = $srtyear+4;
}

if($tterm==0){
	//fall
	$tterm = 7;
}
elseif($tterm==1){
	//spring
	$tterm = 1;
}
elseif($tterm==2){
	//summer
	$tterm = 4;
}

$termtaken = $srtyear .+ $tterm;


$grade = null;

echo $studentid;
echo " ";
echo $courseid;
echo " ";
echo $grade;
echo " ";
echo $termtaken;
echo " ";
echo $status;

//remove existing id
$sql = "DELETE FROM studentcourse
		WHERE studentid = ? 
		AND courseid = ?";
$sqlStmt = $connection->prepare($sql);
$sqlStmt->bind_param('ss', $studentid, $courseid);
$sqlStmt->execute();

//insert new id
$sql = "INSERT INTO studentcourse (studentid, courseid, grade, termtaken, status)
		VALUES (?, ?, ?, ?, ?)";
$sqlStmt = $connection->prepare($sql);
$sqlStmt->bind_param('sssss', $studentid, $courseid, $grade, $termtaken, $status);
$sqlStmt->execute();


?>
</body>
</html>