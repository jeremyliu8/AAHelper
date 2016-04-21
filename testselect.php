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
		echo $advisors;

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
                echo $name;
                $name = ""; // reset the name for next advisor.
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
?>
