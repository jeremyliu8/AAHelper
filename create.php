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
    $servername = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "aahelper";

    // POST variables
    $studentid = $_POST['studid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = hash('SHA512', $_POST['password']);
    $major = $_POST['major'];
    $advid = $_POST['advisor'];

    // connect to the database and insert the new user
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO student (studentid, fname, lname, email, password, major, advid) VALUES ('$studentid', '$fname', '$lname', '$email', '$password', '$major', '$advid')";
        
        // use exec() because no results are returned
        $conn->exec($query);

        echo "<h2 class='success'>&#x2713; New Student Added Successfully!</h2>";
        echo "<p>Click <a href='index.php'>here</a> to go to your new account!</p>";

    }
    catch(PDOException $e) {
        echo "<h2 class='error'>&#x2717; Uh-oh! There was an error adding the student!</h2>";
        if (strpos($e, "1062 Duplicate entry")) {
            echo "<p>NOTICE: Looks like the student you are adding is already in use!</p>";
        }
        echo "<p>Click <a href='index.php'>here</a> to go back to the login page!</p>";
    }

    $conn = null;
?>
    <!-- include footer -->
    <?php include 'footer.php'; ?>
</body>
</html>