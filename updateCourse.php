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
    $courseid = validate_input($_POST['courseid']);
    $classname = validate_input($_POST['classname']);
    $units = $_POST['units'];
    $oldCourseId = validate_input($_POST['oldCourseId']);
    
    if (isset($_POST['prereqs'])) {
        $prereqs = $_POST['prereqs'];
    }
    if (isset($_POST['coreqs'])) {
        $coreqs = $_POST['coreqs'];
    }

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

    $updateCourse = "UPDATE courses 
                    SET courseid = ?, classname = ?, units = ?, term = ?
                    WHERE courseid = ?;";

    $updateCourseStmt = $connection->prepare($updateCourse);
    $updateCourseStmt->bind_param('ssiss', $courseid, $classname, $units, $term, $oldCourseId);


    if ($updateCourseStmt->execute() == TRUE) {
        // Delete all prereqs and coreqs so we can re-add them.
        // Or remove them if they were unselected.
        $sql = "DELETE FROM prereq
            WHERE courseid = '$oldCourseId'";
        $connection->query($sql);

        $sql = "DELETE FROM coreq
            WHERE courseid = '$oldCourseId'";
        $connection->query($sql);


        // Re-add all new prereqs and coreqs
        if (isset($prereqs) && !empty($prereqs)) {
            foreach ($prereqs as $prereq) {
                $sql = "INSERT INTO prereq (courseid, prereqid)
                        VALUES ('$courseid', '$prereq')";
                $connection->query($sql);
            }
        }
        if (isset($coreqs) && !empty($coreqs)) {
            foreach ($coreqs as $coreq) {
                $sql = "INSERT INTO coreq (courseid, coreqid)
                        VALUES ('$courseid', '$coreq')";
                $connection->query($sql);
            }
        }
        echo "<h2 class='success'>&#x2713; Class Updated Successfully!</h2>";
        echo "<p>Click <a href='searchcourse.php'>here</a> to go back</p>";
    } else {
        echo "<h2 class='error'>&#x2717; Uh-oh! There was an error updating the class!</h2>";
        echo "<p>Error: " . $connection->error . "</p>";
        echo "<p>Click <a href='javascript:history.back()'>here</a> to go try again</p>";
    }


    $connection->close();
    ?>
    <!-- include footer -->
    <?php include 'footer.php'; ?>
</body>
</html>