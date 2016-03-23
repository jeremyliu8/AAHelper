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
		$_SESSION['username'] = validateInput($_POST['user']);
		$_SESSION['password'] = hash('sha512', validateInput($_POST['password']));

		$checkID = "SELECT password
					FROM student
					WHERE studentid = $user;";

		$checkEmail = "	SELECT password
						FROM student
						WHERE email = $user;";

		echo $checkEmail;

		$result = $connection->query($checkEmail);

		if ($result === FALSE) {
			return FALSE;
		}

		$result = $connection->query($checkID);
		if ($result->num_rows < 1) {
			$usernameErr = "<p class='error'>* Username not found</p>";
		}

		if (hash_equals($password, $result->fetch_row())) {
			header("Location: form.php");
		}
		else {
			$passwordErr = "<p class='error'>* Password does not match</p>";
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
function logged_in($connection) {
	// Check if all session variables are set
	if (isset($_SESSION['username'], $_SESSION['studentid'])) {
		$username = $_SESSION['username'];
		$studentid = $_SESSION['stduentid'];
		// Get the user-agent string of the user
		$user_browser = $_SESSION['HTTP_USER_AGENT'];

		if ($sql = $connection->prepare("SELECT password
										 FROM aahelper
										 WHERE id = ? LIMIT 1")) {
			// Bind $username to parameter.
			$sql->bind_param('i',$studentid);
			$sql->execute();
			$stmt->store_result();

			if ($stmt->num_rows == 1) {
				// If the user exists get variables from result.
				$stmt->bind_result($password);
				$stmt->fetch();
				$login_check = hash('sha512', $password . $user_browser);

				if (hash_equals($login_check, $login_string)) {
					// We are logged in!
					return true;
				}
				else {
					return false;
				}
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	else {
		return false; // Not logged in
	}
}

function validateInput($input) {
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}



?>