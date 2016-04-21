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
            header("location: form.php");
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

        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1 class="title text-center">Compass</h1>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 form">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <fieldset class="form-group">
                            <label for="user">E-mail</label>  
                            <input type="text" id="user" class="form-control" name="user" placeholder="Enter E-mail" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="pass">Password</label>  
                            <input type="password" id="pass" class="form-control" name="password" placeholder="Enter Password" required>
                        </fieldset>
                        <button type="submit" class="btn btn-lg btn-primary">Login</button>
                    </form>
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div class="row text-center">
                <p class="signup">If you do not have an account yet, <a class="link" href="onboard.php">click here</a></p>
            </div>
            <div class="row">  
                <div class="text-center">
                    <?php include_once "footer.php"; ?>
                </div>
            </div>
        </div>
    </body>   
</html>
