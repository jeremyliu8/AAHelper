<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Course</title>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css"/>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- // <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> -->

        <script src="js/bootstrap-select.js"/></script>
        <script src="js/bootstrap.min.js"></script>
<body>
    <?php
    // Database information
    require_once 'includes/db_connect.php';
    require_once 'includes/functions.php';

    // POST variables
    $courseid = validate_input($_POST['courseid']);
    $classname = validate_input($_POST['classname']);
    $units = $_POST['units'];
    $majorid = $_POST['majorid'];
    
    if (isset($_POST['prereqs'])) {
        $prereqs = $_POST['prereqs'];
    }
    if (isset($_POST['coreqs'])) {
        $coreqs = $_POST['coreqs'];
    }

    // Determine whether required or not
    if (isset($_POST['required'])) {
        $required = "ELECTIVE";
    } else {
        $required = "REQUIRED";
    }

    // Calculate the term
    $term = "";
    if (isset($_POST['fall'])) {
        $term .= "1";
    } else {
        $term .= "0";
    }

    if (isset($_POST['spring'])) {
        $term .= "1";
    } else {
        $term .= "0";
    }

    if (isset($_POST['summer'])) {
        $term .= "1";
    } else {
        $term .= "0";
    }

    $newCourse = "INSERT INTO courses (courseid, classname, units, term) 
            VALUES (?, ?, ?, ?)";

    $newCourseStmt = $connection->prepare($newCourse);
    $newCourseStmt->bind_param('ssis', $courseid, $classname, $units, $term);

    $courseMajor = "INSERT INTO major (majorid, courseid, required)
            VALUES (?, ?, ?)";

    $courseMajorStmt = $connection->prepare($courseMajor);
    $courseMajorStmt->bind_param('sss', $majorid, $courseid, $required);
    
    if ($newCourseStmt->execute() == TRUE && $courseMajorStmt->execute() == TRUE) {
        // Insert all the prereqs into the database
        if (isset($prereqs) && !empty($prereqs)) {
            foreach ($prereqs as $prereq) {
                $sql = "INSERT INTO prereq (courseid, prereqid)
                        VALUES ('$courseid', '$prereq')";
                $connection->query($sql);
            }
        }
        // Insert all the coreqs into the database
        if (isset($coreqs) && !empty($coreqs)) {
            foreach ($coreqs as $coreq) {
                $sql = "INSERT INTO coreq (courseid, coreqid)
                        VALUES ('$courseid', '$coreq')";
                $connection->query($sql);
            }
        } ?>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 text-center">
                    <h2 class='success'>&#x2713; New Course Added Successfully!</h2>
                    <p>Click <a href='searchcourse.php'>here</a> to view all courses.</p>
                </div>
                <div class="col-md-4">
                </div>
            </div>  
        </div>
    <?php } else { ?>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 text-center">
                    <h2 class='success'>&#x2717; Uh-oh! There was an error adding the class!</h2>
                    <p>Click <a href='javascript:history.back()'>here</a> to try again.</p>
                </div>
                <div class="col-md-4">
                </div>
            </div>  
        </div>
    <?php }


    $connection->close();
    ?>
    <!-- include footer -->
    <div class="row text-center extra-top">
        <?php include_once "footer.php" ?>
    </div>
</body>
</html>