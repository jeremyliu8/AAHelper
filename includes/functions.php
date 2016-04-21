<?php

/**
* login function
* 
* This function attempts to login the user
* 
* @params = mysqli object
* returns = boolean (true if connected, false if not)
*/
function login($connection) {
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$user = validate_input($_POST['user']);
		$password = hash('sha512', validate_input($_POST['password']));

		$checkStudent = "	SELECT *
							FROM student
							WHERE email = ? LIMIT 1;";

		$checkAdvisor = "	SELECT *
							FROM advisor
							WHERE email = ? LIMIT 1;";

		// Prepare the statement, bind parameters, then execute!
		// mysqli::prepare returns a mysqli_stmt object or false if an error occurred
		$stmt = $connection->prepare($checkAdvisor);
		$stmt->bind_param('s', $user);
		$stmt->execute();

		// $result stores the mysqli_result object
    	$result = $stmt->get_result(); 

    	$storedAdvisor = $result->fetch_assoc();

    	if (!empty($storedAdvisor)) {
    		if (hash_equals($password, $storedAdvisor['password'])) {
    			// That means the user is an advisor! Let's set the session variables...
    			$_SESSION['fname'] = $storedAdvisor['fname'];
				$_SESSION['lname'] = $storedAdvisor['lname'];
				$_SESSION['advid'] = $storedAdvisor['advid'];
				$_SESSION['password'] = $storedAdvisor['password'];
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['timeout'] = time();

				$connection->close();

				// Take them to the advisor homepage
				header("Location: advisor_home.php");
    		}
    		else {
				// Set the passwordErr variable to display on the login page
				$_SESSION['passwordErr'] = "<p class='error'>* Incorrect password</p>";
				$connection->close();
    		}
    	}
    	else {
    		// No match found in the advisor table, so check the student table
			$stmt = $connection->prepare($checkStudent);
			$stmt->bind_param('s', $user);
			$stmt->execute();

	    	$result = $stmt->get_result(); 

	    	$storedStudent = $result->fetch_assoc();
	    	write_to_file($storedStudent, "Stored Student");
			if (!empty($storedStudent)) {
				if (hash_equals($password, $storedStudent['password'])) {
					// That means the user is a student! Let's set the session variables...
					$_SESSION['fname'] = $storedStudent['fname'];
					$_SESSION['lname'] = $storedStudent['lname'];
					$_SESSION['studentid'] = $storedStudent['studentid'];
					$_SESSION['major'] = $storedStudent['major'];
					$_SESSION['startyear'] = $storedStudent['startyear'];
					$_SESSION['password'] = $storedStudent['password'];
					$_SESSION['loggedin'] = TRUE;
					$_SESSION['timeout'] = time();

					$connection->close();

					// Take them to the student homepage!
					header("Location: form.php");
				}
				else {
					$_SESSION['passwordErr'] = "<p class='error'>* Incorrect password</p>";
					$connection->close();

				}
			}
			else {
				$_SESSION['usernameErr'] = "<p class='error'>* Username not found</p>";
				$connection->close();
			}
		}
	}
}



/**
* logged_in function
* 
* This function checks if there is a user logged in or not
* First checks if loggedin session variable is set
* If it is set, see if it has timed out or not.
* 
* @params = mysqli object
* returns = boolean (true if connected, false if not)
*/
function logged_in() {
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) {
        if ($_SESSION['timeout'] + 60 * 60 < time()) { // Times out after 60 minutes
	    	return false;
		} else {
		    return true;
		}
    }
    else {
    	return false;
    }
}



/**
* write_to_file function
* 
* This function is used to write the parameter given to a file.
* Meant for debugging purposes.
* 
* @params = String or array()
* @params = String
* returns = void
*/
function write_to_file($param, $name = "\$data") {

	date_default_timezone_set('America/Los_Angeles');

	// Specify the file to write to
	$file = __DIR__ . "/debug.txt";
  	$open_file = fopen($file, "a");

  	fwrite($open_file, "\n");

  	$timestamp = "[" . date('M d, Y h:i:s A') . "] " . $name . " = ";
  	fwrite($open_file, $timestamp);

  	if (is_array($param)) {
  		$array2String = print_r($param, TRUE);
  		fwrite($open_file, $array2String);
  	}
  	else if (is_object($param)) {
  		fwrite($open_file, "Is an object and cannot be written.");
  	}
  	else {
  		if ($param == "") {
  			fwrite($open_file, "No Data Found.");
  		} else {
  			fwrite($open_file, $param);
  		}
  	}
    fclose($open_file);
}



/**
* validate_input function
* 
* This function is used to validate user input to protect
* inputs and form fields from code injection.
* 
* @params = String
* returns = String
*/
function validate_input($input) {
	$input = trim($input); // Get rid of any extra white space on either end
	$input = stripslashes($input); // get rid of any slashes '/'
	$input = htmlspecialchars($input); // prevents code injection by preserving html entities
	return $input;
}

//term checker (checks one int)
function validate_term($termid, $takenspace, $i){
	if($termid == 1){
		// available to take
		if($takenspace==$i){
			return "style='background-color:green;'";
		} else {
			return "";

		}	
	} else {
		// Closed, toggle off.
		return "style='background-color:black;'";
	}
}

function searchFile($connection) {
	if ($_SERVER["REQUEST_METHOD"] == "GET") {

		$search = validate_input($_GET['search']);
		//$password = hash('sha512', validate_input($_POST['password']));

		$checkSearch = "SELECT *
						FROM student 
						where fname = ? LIMIT 1;"; //removed where email

		// Prepare the statement, bind parameters, then execute!
		// mysqli::prepare returns a mysqli_stmt object or false if an error occurred
		$stmt = $connection->prepare($checkSearch);
		$stmt->bind_param('s', $search);
		$stmt->execute();

		// $result stores the mysqli_result object
    	$result = $stmt->get_result(); 

    	$storedSearch = $result->fetch_assoc();

		if (!empty($storedSearch)) {
			if (hash_equals($search, $storedSearch['fname'])) {
				// That means we are in! Let's set the session variables...
				$_SESSION['fname'] = $storedSearch['fname'];
				$_SESSION['lname'] = $storedSearch['lname'];
				$_SESSION['studentid'] = $storedSearch['studentid'];
				$_SESSION['major'] = $storedSearch['earufh'];
				$_SESSION['password'] = $storedSearch['password'];
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['timeout'] = time();

				$connection->close();

				// Take them to the student homepage!
				header("Location: StudentList2.php");
			}
			else {
				// Set the passwordErr variable to display on the login page
				$_SESSION['passwordErr'] = "<p class='error'>* Incorrect password</p>";
				$connection->close();

			}
		}
		else {
			// Set the usernameErr variable to display on the login page
			$_SESSION['usernameErr'] = "<p class='error'>* Username not found</p>";
			$connection->close();
		}
	}
}

?>