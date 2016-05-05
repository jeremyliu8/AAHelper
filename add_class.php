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
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css"/>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <title>Add a Course</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- // <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> -->
        <script src="js/bootstrap-select.js"/></script>
        <script src="js/bootstrap.min.js"></script>

    </head>
    <body>
        <!-- if( $posted ) {
            if( $result ) 
                echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
            else
                echo "<script type='text/javascript'>alert('failed!')</script>";
        } -->
        <div class="container">
            <div class="row">
                <h2 class="title text-center">Add A New Class</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 form">
                    <form method="post" action="createCourse.php">
                     <fieldset class="form-group"> 
                            <input type="text" class="form-control" name="courseid" placeholder="Course ID" maxlength="9" required>
                       </fieldset>
                       <fieldset class="form-group"> 
                            <input type="text" class="form-control" name="classname" placeholder="Class Name" required>
                       </fieldset>
                       <fieldset class "form-group">
                            <select class="form-control original" data-width="100%" name="units" title="Select Amount of Units">
                            <option value="1">1 unit</option>
                            <option value="2">2 units</option>
                            <option value="3">3 units</option>
                            <option value="4">4 units</option>
                            <option value="5">5 units</option>
                            </select>
                        </fieldset>
                        <fieldset class="form-group text-center extra-top"> 
                            <label for="terms">Terms Available</label>
                        </fieldset>
                        <fieldset class="form-group text-center checkbox-space">
                            <input type="checkbox" class "textbook-space" name="fall" value="fall">Fall
                            <input type="checkbox" class "textbook-space" name="spring" value="spring">Spring
                            <input type="checkbox" class "textbook-space" name="summer" value="summer">Summer
                        </fieldset>
                        
                        <div class ="text-center">
                            <button type="submit" class="btn-primary extra-top">Submit</button>
                        </div>
                     </form>
                </div>
             </div>
        </div>
       
        <div class="extra-top text-center">
             <a href="includes/logout.php" class="logout">Logout</a>
        </div>
        

        
        <!-- include footer -->
        <div class="row text-center extra-top">
            <?php include_once "footer.php" ?>
        </div>
    </body>   
</html>
