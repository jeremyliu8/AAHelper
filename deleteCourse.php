<?php
    // Database information
    require_once 'includes/db_connect.php';
    require_once 'includes/functions.php';

    $courseid = $_GET['courseid'];

    // Delete prereqs first
    $deleteCourse = "DELETE FROM prereq 
                  WHERE courseid = ?";

    $deleteStmt = $connection->prepare($deleteCourse);
    $deleteStmt->bind_param('s', $courseid);
    $deleteStmt->execute();

    // Then delete coreqs
    $deleteCourse = "DELETE FROM coreq 
                  WHERE courseid = ?";

    $deleteStmt = $connection->prepare($deleteCourse);
    $deleteStmt->bind_param('s', $courseid);
    $deleteStmt->execute();

    // Then delete from major
    $deleteCourse = "DELETE FROM major 
                  WHERE courseid = ?";

    $deleteStmt = $connection->prepare($deleteCourse);
    $deleteStmt->bind_param('s', $courseid);
    $deleteStmt->execute();

    // Finally delete course
    $deleteCourse = "DELETE FROM courses 
                  WHERE courseid = ?";

    $deleteStmt = $connection->prepare($deleteCourse);
    $deleteStmt->bind_param('s', $courseid);
    $deleteStmt->execute();

    $connection->close();

    header("Location: searchcourse.php");

?>