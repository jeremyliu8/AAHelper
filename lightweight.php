<!DOCTYPE html>
<?php 
    session_start();

    $username = "user";
    $password = "password";

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        header("Location: success.php");
    }

    if (isset($_POST['username']) && isset($_POST['password'])) {
        if ($_POST['username'] == $username && $_POST['password'] == $password) {
            $_SESSION['loggedin'] = true;
            header("Location: success.php");
        }
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Advising Helper 1.0</title>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <?php 
            if (strpos("hay@stack", "@")) {
                echo "Found it!";
            }
            else
                echo "where is it?";
        ?>

        <!-- include footer -->
        <?php include 'footer.php'; ?>
    </body>   
</html>
