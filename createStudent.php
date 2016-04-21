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

    // POST variables
    $studentid = $_POST['studid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = hash('SHA512', $_POST['password']);
    $major = $_POST['major'];
    $startyear = $_POST['startyear'];
    $advid = $_POST['advisor'];

    $newStudent = "INSERT INTO student (studentid, fname, lname, email, password, major, startyear, advid) 
            VALUES ('$studentid', '$fname', '$lname', '$email', '$password', '$major', '$startyear', '$advid')";
    
    if ($connection->query($newStudent) === TRUE) {
        echo "<h2 class='success'>&#x2713; New Student Added Successfully!</h2>";
        echo "<p>Click <a href='index.php'>here</a> to go to your new account!</p>";
    } else {
        echo "<h2 class='error'>&#x2717; Uh-oh! There was an error adding the student!</h2>";
        echo "<p>Error: " . $connection->error . "</p>";
        echo "<p>Click <a href='index.php'>here</a> to go back to the login page!</p>";
    }

    $connection->close();
    ?>
    <!-- include footer -->
    <?php include 'footer.php'; ?>
</body>
</html>