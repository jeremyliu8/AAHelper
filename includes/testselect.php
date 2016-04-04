
<!DOCTYPE html>
<html>
<head>
    <title>Test Out a Select</title>
</head>
<body>
<h3>Students:</h3>
<ul>
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
            $query = $conn->prepare("SELECT studentid, fname, lname FROM student");
            $query->execute();
            
            //set the resulting array to associative
            $result = $query->setFetchMode(PDO::FETCH_ASSOC);

            $advisors = $query->fetchAll();
		    
            //print_r($advisors);

            $name = "";
            $advid = "";
            foreach ($advisors as $key => $value) {
                foreach ($value as $k => $v) {
                    if ($k !== 'studentid') {
                        $name .= $v . " ";
                    }
                    else {
                        $advid = $v;
                    }
                }
                trim($name); // trim off any whitespace
                echo "<li>" . $name . "</li>";
                $name = ""; // reset the name for next advisor.
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>
    </ul>
</body>
</html>