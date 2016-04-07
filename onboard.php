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
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <h1 class="title">Create a New Account</h1>
        <div id="newuser" class ="form">
            <form method="post" action="create.php">
                <p><input type="text" class="input" name="studid" placeholder="Student ID" required></p>
                <p><input type="text" class="input" name="fname" placeholder="First Name" required></p>
                <p><input type="text" class="input" name="lname" placeholder="Last Name" required></p>
                <p><input type="text" class="input" name="email" placeholder="E-Mail" required></p>
                <p><input type="password" class="input" name="password" placeholder="Password" required></p>
                <p><select name="major" class="dropdown">
                    <option value="CS">Computer Science</option>
                    <option value="CIS">Computer Information Systems</option>
                </select></p>
                <p><input type="text" class="input" name="startyear" placeholder="Start Year" required></p>
                <p><select name="advisor" class="dropdown" required>
                    <option value="default">Select your advisor...</option>
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
                        $connection->close();
                    ?>
                </select></p>
                <p><input type="submit" class="go" value="Create!"></p>
                <p>
            </form>
        </div>
        
        <!-- include footer -->
        <?php include 'footer.php'; ?>
    </body>   
</html>
