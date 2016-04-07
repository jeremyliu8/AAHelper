<!DOCTYPE html>
<?php 
	session_start();

	//open database
	require_once 'includes/db_connect.php';
	require_once 'includes/functions.php';

	if (!logged_in() || !isset($_SESSION['advid'])) {
  		header("Location: index.php");
	}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $_SESSION['fname'] ?> | Home</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700' rel='stylesheet' type='text/css'>
</head>
<body>
    <nav class="navbar navbar-default navbar-inverse">
        <div class="container-fluid"> 
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"></button>
                <a class="navbar-brand">Advisor</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li> </li>
                    <li> </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a>
                    <?php   
                        echo $_SESSION['fname'];
                        echo " ";
                        echo $_SESSION['lname']; 
                    ?>
                    </a></li>
                    <li>&nbsp;</li>
                    <li><a><?php echo $_SESSION['advid']; ?></a></li>
                </ul>
            </div>
        </div>
    </nav>

	<h1 class="title">Search For Your Students</h1>
    <div class="home">    
        <form id="searchbox" action="" method="get" accept-charset-'UTF-8'>
            <input id="search" type="text" placeholder="#ID or Username" class="input">
            <input id="submit" type="submit" value="Search" class="go">
        </form>
    
        <a href="form.php" class="go listbuttons fast">Plan Advising</a>
        <a href="add_class.php" class="go listbuttons fast">Add a Class</a>
        <a href="form.php" class="go listbuttons fast">Manage Accounts</a>
    </div>    

    <center><a href="includes/logout.php">Logout</a></center>

    <!-- include footer -->
    <center>
      <?php include 'footer.php'; ?>
    </center>

</body>
</html>