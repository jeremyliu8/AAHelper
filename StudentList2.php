Hello there 
<?php
// studentid of selected student
echo $_POST["studentnum"]; 

//open database
$fulldb = mysql_connect('localhost', 'root', '');

mysql_select_db('aahelper', $fulldb);


//course history from CS student
$students = "SELECT * FROM csstudentcourse";



$result = mysql_query($students);



mysql_close($fulldb);
?>