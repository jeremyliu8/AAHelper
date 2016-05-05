<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css"/>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <title>Add a Course</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- // <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> -->
        <script src="js/bootstrap-select.js"/></script>
        <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <?php
    // Database information
    require_once 'includes/db_connect.php';
    require_once 'includes/functions.php';

    // POST variables
    $courseid = $_POST['courseid'];
    $classname = $_POST['classname'];
    $units = $_POST['units'];

    // calculate the term
    $term = "";
    if (isset($_POST['fall'])) {
        $term .= "1";
    } else {
        $term .= "0";
    }

    if (isset($_POST['spring'])) {
        $term .= "1";
    } else {
        $term .= "0";
    }

    if (isset($_POST['summer'])) {
        $term .= "1";
    } else {
        $term .= "0";
    }


    write_to_file($term, "\$term");


    $newCourse = "INSERT INTO courses (courseid, classname, units, term) 
             VALUES ('$courseid', '$classname', '$units', '$term')";
    
    if ($connection->query($newCourse) === TRUE) {
        ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4 text-center">
                        <h2 class='success'>&#x2713; New Class Added Successfully!</h2>
                        <p>Click <a href='advisor_home.php'>here</a> to go back</p>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>  
            </div>
    <?php } else { ?>
            <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4 text-center">
                            <h2 class='error'>&#x2717; Uh-oh! There was an error adding the class!</h2>
                            <p>Error: <?php echo $connection->error ?> </p>
                            <p>Click <a href='add_class.php'>here</a> to go try again</p>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>  
                </div>
    <?php }


    $connection->close();
    ?>
    <!-- include footer -->
      <div class="row text-center extra-top">
            <?php include_once "footer.php" ?>
      </div> 
</body>
</html>