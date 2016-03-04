login verification: pseudocode


// check www.w3schools.com/php/php_form_required.asp
// see also mrbool.com/how-to-create-a-login-page-with-php-and-mysql/28656


// Connect to DB
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_POST['user'];
$password = md5($_POST['pass']); // keep passwords secure even though we are using $_POST

function signIn() {

	session_start();

	if (!empty($_POST['user'])) { // If there is at least some text in user
		$query = $conn->prepare("SELECT * FROM student where userName = '$_POST[user]' AND password = '$_POST[pass]'");
	 	$query->execute();
	 	$row = $query->fetchAll();

	 	if (!empty($row['userName']) AND !empty($row['userName'])) {
	 		$_SESSION['userName'] = $row['pass'];
	 		echo "SUCCESSFULL LOGIN TO USER PROFILE PAGE...";
	 	}
	}
}