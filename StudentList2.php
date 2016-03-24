Hello there 
<style>
table, th, td {
    border: 1px solid black;
}
</style>
<?php
// studentid of selected student
// $stunum = $_POST["studentnum"];
// echo $_POST["studentnum"]; 

$stunum = '002406078';
echo $stunum;

//open database
$fulldb = mysql_connect('localhost', 'root', '');

mysql_select_db('aahelper', $fulldb);


//course history from studentcourse

$coursehistory = "SELECT * FROM studentcourse where studentid='$stunum'";

$result = mysql_query($coursehistory);

//magic

?> 
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="jumbotron">
    <table>
  	<tr>
	    <th>Course ID</th>
	    <th>Course Grade</th>
	    <th>Term Taken</th>
  	</tr>
<?php

while ($row = mysql_fetch_object($result)) {
	?> <tr> <td> <?php
	echo $row->courseid;
	?> </td> <?php
	?> <td> <?php
	echo $row->grade;
	?> </td> <?php
	?> <td> <?php
	echo $row->termtaken;
	?> </td> <?php
}

?> </tr>
</table>
</div>
</div>
</div>
</div> <?php

mysql_close($fulldb);
?>