<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User</title>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700' rel='stylesheet' type='text/css'>
</head>
<body>
    <?php
    // Database information
    require_once 'includes/db_connect.php';
    require_once 'includes/functions.php';

    // POST variables
    $courseid = $_POST['courseid'];
    $classname = $_POST['classname'];
    $units = $_POST['units'];
    $oldCourseId = $_POST['oldCourseId'];
    // $oldClassName = $_POST['oldClassName'];
    // $oldUnits = $_POST['oldUnits'];
    // $oldTerm = $_POST['oldTerm'];

    // echo $oldCourseId;
    // echo $oldClassName;
    // echo $oldUnits;
    // echo $oldTerm;

    // calculate the term
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

    // write_to_file($term, "\$term");


    $updateCourse = "UPDATE courses 
                    SET courseid = ?, classname = ?, units = ?, term = ?
                    WHERE courseid = ?;";

    $updateCourseStmt = $connection->prepare($updateCourse);
    $updateCourseStmt->bind_param('ssiss', $courseid, $classname, $units, $term, $oldCourseId);


    // <--(courseid, classname, units, term) 
    //     <--     VALUES ('$courseid', '$classname', '$units', '$term')";
    
    if ($updateCourseStmt->execute() == TRUE) {
        echo "<h2 class='success'>&#x2713; Class Updated Successfully!</h2>";
        echo "<p>Click <a href='advisor_home.php'>here</a> to go back</p>";
    } else {
        echo "<h2 class='error'>&#x2717; Uh-oh! There was an error updating the class!</h2>";
        echo "<p>Error: " . $connection->error . "</p>";
        echo "<p>Click <a href='add_class.php'>here</a> to go try again</p>";
    }


    $connection->close();
    ?>
    <!-- include footer -->
    <?php include 'footer.php'; ?>
</body>
</html>