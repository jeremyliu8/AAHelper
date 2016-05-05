<!DOCTYPE html>
<?php 
    
    session_start();

    // Connect to the Database
    require_once 'includes/db_connect.php';
    require_once 'includes/functions.php'; 

    $courseid = $_GET['courseid'];

    $sql = "SELECT * 
             FROM courses
             WHERE courseid = ?";
    $course = $connection->prepare($sql);
    $course->bind_param('s', $courseid);
    $course->execute();

    $result = $course->get_result();

    $depcourseid = null;
    $depclassname = null;
    $depunits = null;
    $depterm = null;

    while($row = $result->fetch_assoc()){
        $depcourseid = $row['courseid'];
        $depclassname = $row['classname'];
        $depunits = $row['units'];
        $depterm = $row['term'];
    }

    // Store all prereqs in an array
    $sql = "SELECT * 
             FROM prereq
             WHERE courseid = ?";
    $prereqStmt = $connection->prepare($sql);
    $prereqStmt->bind_param('s', $courseid);
    $prereqStmt->execute();

    $result = $prereqStmt->get_result();

    $prereqArray = array();

    while($row = $result->fetch_assoc()){
        $prereqArray[] = $row['prereqid'];
    }


    if (!logged_in() || !isset($_SESSION['advid'])) {
        header("Location: index.php");
    }

    // Store all coreqs in an array
    $sql = "SELECT * 
             FROM coreq
             WHERE courseid = ?";
    $coreqStmt = $connection->prepare($sql);
    $coreqStmt->bind_param('s', $courseid);
    $coreqStmt->execute();

    $result = $coreqStmt->get_result();

    $coreqArray = array();

    while($row = $result->fetch_assoc()){
        $coreqArray[] = $row['coreqid'];
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Course</title>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css"/>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>

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
                <h2 class="title text-center">Edit Course</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 form">
                    <form method="post" action="updateCourse.php">
                        <fieldset class="form-group"> 
                            <label>Course ID:</label>
                            <input type="text" class="form-control" name="courseid" placeholder="Course ID" maxlength="9" value="<?php echo $courseid; ?>" autocomplete="off" required>
                            <input type="hidden" name="oldCourseId" value="<?php echo $courseid; ?>"></input>
                        </fieldset>
                        <fieldset class="form-group"> 
                            <label>Course Name:</label>
                            <input type="text" class="form-control" name="classname" placeholder="Class Name" maxlength="50" value="<?php echo $depclassname; ?>" autocomplete="off" required>
                            <input type="hidden" name="oldClassName" value="<?php echo $depclassname; ?>"></input>
                        </fieldset>
                        <feildset>    
                            <select class="selectpicker" data-width="100%" name="units" title="Units...">
                                <option value="1" <?php if ($depunits == 1) {
                                echo "selected";
                                } ?> >1 Unit</option>
                                <option value="2"<?php if ($depunits == 2) {
                                echo "selected";
                                } ?> >2 Units</option>
                                <option value="3"<?php if ($depunits == 3) {
                                echo "selected";
                                } ?> >3 Units</option>
                                <option value="4"<?php if ($depunits == 4) {
                                echo "selected";
                                } ?> >4 Units</option>
                                <option value="5"<?php if ($depunits == 5) {
                                echo "selected";
                                } ?> >5 Units</option>
                            </select>
                            <input type="hidden" name="oldUnits" value="<?php echo $depunits; ?>"></input>
                        </feildset>
                        <fieldset class="form-group text-center extra-top"> 
                            <label for="terms">Terms Available</label>
                        </fieldset>
                        <fieldset class="form-group text-center">
                                <label class="checkbox-inline"><input type="checkbox" name="fall" value="fall" 
                                <?php 
                                $checked = substr($depterm, -3, 1);
                                if ($checked == 1) {
                                    echo "checked";
                                }?> >Fall</label>
                                <label class="checkbox-inline"><input type="checkbox" name="spring" value="spring"
                                <?php 
                                $checked = substr($depterm, -2, 1);
                                if ($checked == 1) {
                                    echo "checked";
                                }?> >Spring</label>
                                <label class="checkbox-inline"><input type="checkbox" name="summer" value="summer"
                                <?php 
                                $checked = substr($depterm, -1, 1);
                                if ($checked == 1) {
                                    echo "checked";
                                }?> >Summer</label>
                            <input type="hidden" name="oldTerm" value="<?php echo $depterm; ?>"></input>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="prereqs">Pre-Requisites:</label>
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
                                $searchCourseId = "";

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['courseid'] . " - " . $row['classname'];
                                        $searchCourseId = $row['courseid'];
                                        trim($name); // trim off any whitespace

                                        if (in_array($searchCourseId, $prereqArray)) {
                                            echo "<option value='$searchCourseId' title='$searchCourseId' selected>$name</option>";
                                        } elseif ($searchCourseId != $courseid) {
                                            echo "<option value='$searchCourseId' title='$searchCourseId'>$name</option>";
                                        }
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
                                $searchCourseId = "";

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['courseid'] . " - " . $row['classname'];
                                        $searchCourseId = $row['courseid'];
                                        trim($name); // trim off any whitespace
                                        if (in_array($searchCourseId, $coreqArray)) {
                                            echo "<option value='$searchCourseId' title='$searchCourseId' selected>$name</option>";
                                        } elseif ($searchCourseId != $courseid) {
                                            echo "<option value='$searchCourseId' title='$searchCourseId'>$name</option>";
                                        }
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
                            <button type="submit" class="btn-lg btn-primary extra-top">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                </div>
            </div>    
            <div class="row text-center extra-top">
                <?php include_once "footer.php" ?>
            </div>
        </div>
    </body>   
</html>




        