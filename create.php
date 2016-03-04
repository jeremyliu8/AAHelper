<?php
    // Database information
    $servername = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "aahelper";

    // POST variables
    $studentid = $_POST['studid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = hash('SHA512', $_POST['password']);
    $advid = $_POST['advisor'];

    // connect to the database and insert the new user
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO student (studentid, fname, lname, email, username, password, advid) VALUES ('$studentid', '$fname', '$lname', '$email', '$username', '$password', '$advid')";
        
        // use exec() because no results are returned
        $conn->exec($query);

        echo "<h1>New Student Added Successfully</h1>";

    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
?>