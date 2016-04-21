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
</head>
<body>
    <nav class="navbar navbar-default navbar-custom">
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
<div class="container">
    <div class="row">
        <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div class ="text-center">
            <div class="row extra-top">
                <a href="#" class="btn btn-lg btn-primaryButts btn-block">Plan Advising</a>
             </div>
            <div class="row extra-top">
                 <a href="#" class="btn btn-lg btn-primaryButts btn-block">Add A Class</a>
            </div>
            <div class="row extra-top">
                 <a href="#" class="btn btn-lg btn-primaryButts btn-block">Manage Accounts</a>
            </div>
            <div class="extra-top">
                 <a href="includes/logout.php" class="logout">Logout</a>
            </div>
        </div>
     </div>
    <div class="col-md-4">
    </div>

    </div>

</div>       
         <!-- include footer -->
    <center>
      <?php include 'footer.php'; ?>
    </center>

</body>
</html>


































