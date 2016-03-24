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

		$user = validateInput($_POST['user']);
		$password = hash('sha512', validateInput($_POST['password']));

		$checkEmail = "	SELECT *
						FROM student
						WHERE email = ? LIMIT 1;";

		// Prepare the statement and bind parameters
		$stmt = $connection->prepare($checkEmail);
		$stmt->bind_param('s', $user);

		$stmt->execute();

    	$result = $stmt->get_result(); 

    	$storedStudent = $result->fetch_assoc();

    	// if (empty($storedStudent)) {
    	// 	echo "No found results!";
    	// }

    	// echo "<pre>\n";   print_r($storedStudent);   echo "</pre>\n";


		if (!empty($storedStudent)) {
			if (hash_equals($password, $storedStudent['password'])) {
				// That means we are in! Let's set the session variables...
				$_SESSION['fname'] = $storedStudent['fname'];
				$_SESSION['lname'] = $storedStudent['lname'];
				$_SESSION['studentid'] = $storedStudent['studentid'];
				$_SESSION['major'] = $storedStudent['earufh'];
				$_SESSION['password'] = $storedStudent['password'];
				$_SESSION['loggedin'] = TRUE;

				$connection->close();

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

/**
* logged_in function
* 
* This function checks if there is a user logged in or not
* 
* @params = mysqli object
* returns = boolean (true if connected, false if not)
*/
function logged_in() {
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) {
        return true;
    }
    else {
    	return false;
    }
}


function validateInput($input) {
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}

?>