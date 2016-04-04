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

		$checkEmail = "	SELECT *
						FROM student
						WHERE email = ? LIMIT 1;";

		// Prepare the statement, bind parameters, then execute!
		// mysqli::prepare returns a mysqli_stmt object or false if an error occurred
		$stmt = $connection->prepare($checkEmail);
		$stmt->bind_param('s', $user);
		$stmt->execute();

		// $result stores the mysqli_result object
    	$result = $stmt->get_result(); 

    	$storedStudent = $result->fetch_assoc();

		if (!empty($storedStudent)) {
			if (hash_equals($password, $storedStudent['password'])) {
				// That means we are in! Let's set the session variables...
				$_SESSION['fname'] = $storedStudent['fname'];
				$_SESSION['lname'] = $storedStudent['lname'];
				$_SESSION['studentid'] = $storedStudent['studentid'];
				$_SESSION['major'] = $storedStudent['earufh'];
				$_SESSION['password'] = $storedStudent['password'];
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
function write_to_file($param, $name) {

	date_default_timezone_set('America/Los_Angeles');

	// Specify the file to write to
	$file = __DIR__ . "/debug.txt";
  	$open_file = fopen($file, "a");

  	fwrite($open_file, "\n");

  	$timestamp = "[" . date('M d, Y h:i:s A') . "] " . $name . " = ";
  	fwrite($open_file, $timestamp);

  	if (is_array($param)) {
  		fwrite($open_file, print_r($param));
  	}
  	else if (is_object($param)) {
  		fwrite($open_file, "Is an object and cannot be written.");
  	}
  	else {
  		fwrite($open_file, $param);
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

?>