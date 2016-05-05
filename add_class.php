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
        <nav class="navbar navbar-default navbar-custom">
            <div class="container-fluid"> 
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"></button>
                    <a class="navbar-brand" href="advisor_home.php">Advisor</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li> </li>
                        <li> </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="advisor_home.php">
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
                <h2 class="title text-center">Add A New Class</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 form">
                    <form method="post" action="createCourse.php">
                     <fieldset class="form-group"> 
                            <input type="text" class="form-control" name="courseid" placeholder="Course ID" maxlength="9" autocomplete="off" required>
                       </fieldset>
                       <fieldset class="form-group"> 
                            <input type="text" class="form-control" name="classname" placeholder="Class Name" autocomplete="off" required>
                       </fieldset>
                       <fieldset class="form-group">
                            <select class="selectpicker" data-width="100%" name="units" title="Units...">
                                <option value="1">1 Unit</option>
                                <option value="2">2 Units</option>
                                <option value="3">3 Units</option>
                                <option value="4">4 Units</option>
                                <option value="5">5 Units</option>
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                            <select class="selectpicker" data-width="100%" name="majorid">
                                <option value="CS">Computer Science</option>
                                <option value="CIS">Computer Information Systems</option>
                            </select>
                        </fieldset>
                        <fieldset class="form-group text-center extra-top"> 
                            <label for="terms">Terms Available</label>
                        </fieldset>
                        <fieldset class="form-group text-center checkbox-space">
                            <label class="checkbox-inline"><input type="checkbox" name="fall" value="fall">Fall</label>
                            <label class="checkbox-inline"><input type="checkbox" name="spring" value="spring">Spring</label>
                            <label class="checkbox-inline"><input type="checkbox" name="summer" value="summer">Summer</label>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="coreqs">Pre-Requisites:</label>
                            <select class="selectpicker"
                                    data-live-search="true"
                                    name="prereqs[]"
                                    multiple
                                    data-selected-text-format="count > 5" 
                                    data-width="100%"
                                    data-size="5"
                                    data-dropup-auto="false"
                                    title="Pre-Requisites...">
                            <?php                         
                                // SQL statement we want to execute
                                $fetchCourses = "SELECT courseid, classname 
                                                  FROM courses;";
                                
                                // store the result object
                                $result = $connection->query($fetchCourses);
                                
                                $name = "";
                                $courseid = "";

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['courseid'] . " - " . $row['classname'];
                                        $courseid = $row['courseid'];
                                        trim($name); // trim off any whitespace
                                        echo "<option value='$courseid' title='$courseid'>$name</option>";
                                        $name = ""; // reset the name for next course.
                                    }
                                }
                            ?>
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="coreqs">Co-Requisites:</label>
                            <select class="selectpicker"
                                    data-live-search="true"
                                    name="coreqs[]"
                                    multiple
                                    data-selected-text-format="count > 5" 
                                    data-width="100%"
                                    data-size="5"
                                    data-dropup-auto="false"
                                    title="Co-Requisites...">
                            <?php                         
                                // SQL statement we want to execute
                                $fetchCourses = "SELECT courseid, classname 
                                                  FROM courses;";
                                
                                // store the result object
                                $result = $connection->query($fetchCourses);
                                
                                $name = "";
                                $courseid = "";

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['courseid'] . " - " . $row['classname'];
                                        $courseid = $row['courseid'];
                                        trim($name); // trim off any whitespace
                                        echo "<option value='$courseid' title='$courseid'>$name</option>";
                                        $name = ""; // reset the name for next course.
                                    }
                                }
                                $connection->close();
                            ?>
                            </select>
                        </fieldset>
                        <fieldset class="form-group text-center checkbox-space">
                            <label class="checkbox-inline"><input type="checkbox" name="required">Elective</label>
                        </fieldset>
                        
                        <div class ="text-center">
                            <button type="submit" class="btn-lg btn-primary extra-top">Create!</button>
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
