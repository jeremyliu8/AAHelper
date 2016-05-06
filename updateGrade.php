<!DOCTYPE html>
<html>
<head>

<?php
require_once 'includes/db_connect.php';

//In Progress
$grade = $_GET['s'];

//CS220-2
$id = $_GET['i'];

//002352690
$studentid = $_GET['st'];

echo $studentid;
echo " ";
echo $id;
echo " ";
echo $grade;


//update grade
$sql = "UPDATE studentcourse 
		SET grade = ?
		WHERE studentid = ?
		AND courseid = ?";
$sqlStmt = $connection->prepare($sql);
$sqlStmt->bind_param('sss', $grade, $studentid, $id);
$sqlStmt->execute();


?>
</body>
</html>