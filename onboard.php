<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Advising Helper 1.0</title>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <h1>Create a New Account</h1>
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
                <p><select name="advisor" class="dropdown">
                    <option value="default">Select your advisor...</option>
                    <?php 
                        $servername = "localhost";
                        $dbuser = "root";
                        $dbpass = "";
                        $dbname = "aahelper";

                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);
                            
                            // set the PDO error mode to exception
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // SQL statement we want to execute
                            $query = $conn->prepare("SELECT advid, fname, lname FROM advisor");
                            $query->execute();
                            
                            //set the resulting array to associative
                            $result = $query->setFetchMode(PDO::FETCH_ASSOC);

                            $advisors = $query->fetchAll();

                            $name = "";
                            $advid = "";
                            foreach ($advisors as $key => $value) {
                                foreach ($value as $k => $v) {
                                    if ($k !== 'advid') {
                                        $name .= $v . " ";
                                    }
                                    else {
                                        $advid = $v;
                                    }
                                }
                                trim($name); // trim off any whitespace
                                echo "<option value='$advid'>$name</option>";
                                $name = ""; // reset the name for next advisor.
                            }
                        }
                        catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    ?>
                </select></p>
                <p><input type="submit" class="go" value="Create!"></p>
            </form>
        </div>
        
        <!-- include footer -->
        <?php include 'footer.php'; ?>
    </body>   
</html>
