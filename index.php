<!DOCTYPE html>
<?php 
    session_start();

    // Connect to the database
    require_once 'includes/db_connect.php';

    // Load functions
    require_once 'includes/functions.php';

    if (logged_in()) {
        if (isset($_SESSION['advid'])) {
            header("location: advisor_home.php");
        }
        else {
            header("location: StudentList2.php");
        }
    }

    // Login using the connection set up in db_connect.php
    login($connection);


    // set error messages to null if no errors
    $usernameErr = "";
    $passwordErr = "";
    
    if (isset($_SESSION['usernameErr'])) {
        $usernameErr = $_SESSION['usernameErr'];
        unset($_SESSION['usernameErr']);
    }
    if (isset($_SESSION['passwordErr'])) {
        $passwordErr = $_SESSION['passwordErr'];
        unset($_SESSION['passwordErr']);
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Compass | Login</title>
        <link rel="icon" href="img/71-compass.png">
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div class="hello">
        </div>
        <header>
            <h1 class="title">Compass</h1>
            <div id="login" class ="form">
                <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" accept-charset='UTF-8'>
                    <p><input type="text" class="input" name="user" placeholder="E-mail" required></p>
                    <p><input type="password" class="input" name="password" placeholder="Password" required></p>
                    <p><input type="submit" class="go" value="Login"></p>
                </form>
                <?php echo $usernameErr; ?>
                <?php echo $passwordErr; ?>
               </div>
            <p>If you do not have an account yet, <a class="link" href="onboard.php">click here</a></p>
        </header>
        
        <!-- include footer -->
        <?php 
            include 'footer.php'; 

        ?>
    </body>   
</html>
