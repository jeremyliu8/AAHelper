<!DOCTYPE html>
<?php 
    session_start();
    // Connect to the Database
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
        <title>Add a Course</title>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <!-- if( $posted ) {
            if( $result ) 
                echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
            else
                echo "<script type='text/javascript'>alert('failed!')</script>";
        } -->

        <h1 class="title">Add A New Course</h1>
        <div id="newuser" class ="form">
            <form method="post" action="createCourse.php">
                <p><input type="text" class="input" name="courseid" placeholder="Course ID" required></p>
                <p><input type="text" class="input" name="classname" placeholder="Class Name" required></p>
                <p><input type="text" class="input" name="units" placeholder="Units" required></p>
                <p>Terms available:</p>
                <p>
                    <input type="checkbox" name="fall" value="fall">Fall
                    <input type="checkbox" name="spring" value="spring">Spring
                    <input type="checkbox" name="summer" value="summer">Summer
                </p>
                <p><input type="submit" class="go" value="Create!"></p>
                <p>
            </form>
        </div>

        <center><a href="includes/logout.php">Logout</a></center>

        
        <!-- include footer -->
        <?php include 'footer.php'; ?>
    </body>   
</html>
