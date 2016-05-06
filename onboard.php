<!DOCTYPE html>
<?php 
    // Connect to the Database
    require_once 'includes/db_connect.php';
    require_once 'includes/functions.php';
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Advising Helper 1.0</title>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css"/>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- // <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> -->

        <script src="js/bootstrap-select.js"/></script>
        <script src="js/bootstrap.min.js"></script>

    </head>
    <body>
         <div class="container">
            <div class="row">
                <h2 class="title text-center">Create a New Account</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 form">
                    <form method="post" action="createStudent.php">
                        <fieldset class="form-group"> 
                            <input type="text" class="form-control" name="studid" placeholder="Student ID" maxlength="9" autocomplete="off" required>
                        </fieldset>
                        <fieldset class="form-group"> 
                            <input type="text" class="form-control" name="fname" placeholder="First Name" autocomplete="off" required>
                        </fieldset>
                        <fieldset class="form-group"> 
                            <input type="text" class="form-control" name="lname" placeholder="Last Name" autocomplete="off" required>
                        </fieldset>
                        <fieldset class="form-group"> 
                            <input type="text" class="form-control" name="email" placeholder="Email" autocomplete="off" required>
                        </fieldset>
                        <fieldset class="form-group"> 
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </fieldset>
                        <fieldset>
                            <select class="selectpicker" data-width="100%" name="major" title="Select Your Major...">
                              <option value="CS">Computer Science</option>
                              <option value="CIS">Computer Information Systems</option>
                            </select>
                        </fieldset>
                        <fieldset class="form-group"> 
                            <input type="text" class="form-control extra-top" name="startyear" placeholder="Start Year" maxlength="4" autocomplete="off" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <select class="selectpicker" data-width="100%" name="advisor" title="Select Your Advisor...">
                            <?php                         
                                // SQL statement we want to execute
                                $fetchAdvisors = "SELECT advid, fname, lname 
                                                  FROM advisor;";
                                
                                // store the result object
                                $result = $connection->query($fetchAdvisors);
                                
                                $name = "";
                                $advid = "";

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['fname'] . " " . $row['lname'];
                                        $advid = $row['advid'];
                                        trim($name); // trim off any whitespace
                                        echo "<option value='$advid'>$name</option>";
                                        $name = ""; // reset the name for next advisor.
                                    }
                                }
                            ?>
                            </select>
                        </fieldset>
                        <fieldset class="form-group">
                            <select class="selectpicker"
                                    data-live-search="true"
                                    name="transferred[]"
                                    multiple
                                    data-selected-text-format="count > 5" 
                                    data-width="100%"
                                    data-size="5"
                                    data-dropup-auto="false"
                                    title="Transferred Classes...">
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

                        <div class ="text-center">
                            <button type="submit" class="btn-lg btn-primary extra-top">Create!</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                </div>
            </div>    
            <div class="row text-center extra-top">
                <p>Already have an account? <a class="link" href="index.php">login here!</a></p>
            </div>
            <div class="row text-center extra-top">
                <?php include_once "footer.php" ?>
            </div>
        </div>
    </body>   
</html>




        