<!DOCTYPE html>
<?php 
	session_start();

	//open database
	require_once 'includes/db_connect.php';
	require_once 'includes/functions.php';

	if (!logged_in()) {
  		header("Location: index.php");
	}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $_SESSION['fname'] ?> | Home</title>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700' rel='stylesheet' type='text/css'>
</head>
<body>
	<h1>Search For Your Students</h1>
    <form id="searchbox" action="" method="get" accept-charset-'UTF-8'>
        <input id="search" type="text" placeholder="#ID or Username" class="input">
        <input id="submit" type="submit" value="Search" class="go">
    </form>
    
    <ul>
        <a href="form1.html" class="button"><li>Plan Advising</li></a>
        <a href="https://calendar.google.com/" class="button"><li>View Your Calendar</li></a>
    </ul>

</body>
</html>