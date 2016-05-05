<!DOCTYPE html>
<?php 
    
    session_start();

    // Connect to the Database
    require_once 'includes/db_connect.php';
    require_once 'includes/functions.php'; 

    $courseid = $_GET['courseid'];

                            $array = "SELECT * 
                                     FROM courses
                                     WHERE courseid = ?";
                            $course = $connection->prepare($array);
                            $course->bind_param('s', $courseid);
                            $course->execute();

                            $result = $course->get_result();

                            $depcourseid = null;
                            $depclassname = null;
                            $depunits = null;
                            $depterm = null;

                            while($row = $result->fetch_assoc()){
                                $depcourseid = $row['courseid'];
                                $depclassname = $row['classname'];
                                $depunits = $row['units'];
                                $depterm = $row['term'];
                            }


    if (!logged_in() || !isset($_SESSION['advid'])) {
        header("Location: index.php");
    }

    //$

?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Course</title>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css"/>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- // <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> -->

        <script src="js/bootstrap-select.js"/></script>
        <script src="js/bootstrap.min.js"></script>

    </head>
    <body>
         <div class="container">
            <div class="row">
                <h2 class="title text-center">Edit Course</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 form">
                    <form method="post" action="updateCourse.php">
                        <fieldset class="form-group"> 
                            <input type="text" class="form-control" name="courseid" placeholder="Course ID" maxlength="9" value="<?php echo $courseid; ?>" required>
                            <input type="hidden" name="oldCourseId" value="<?php echo $courseid; ?>"></input>

                        </fieldset>
                        <fieldset class="form-group"> 
                            <input type="text" class="form-control" name="classname" placeholder="Class Name" maxlength="50" value="<?php echo $depclassname; ?>" required>
                            <input type="hidden" name="oldClassName" value="<?php echo $depclassname; ?>"></input>
                        </fieldset>
                        <feildset>    
                            <select class="form-control original" data-width="100%" name="units">
                                <option value="">Units</option>
                                <option value="1" <?php if ($depunits == 1) {
                                echo "selected='selected'";
                                } ?> >1 </option>
                                <option value="2"<?php if ($depunits == 2) {
                                echo "selected='selected'";
                                } ?> >2</option>
                                <option value="3"<?php if ($depunits == 3) {
                                echo "selected='selected'";
                                } ?> >3</option>
                                <option value="4"<?php if ($depunits == 4) {
                                echo "selected='selected'";
                                } ?> >4</option>
                                <option value="5"<?php if ($depunits == 5) {
                                echo "selected='selected'";
                                } ?> >5</option>
                            </select>
                            <input type="hidden" name="oldUnits" value="<?php echo $depunits; ?>"></input>
                        </feildset>
                        <fieldset class="form-group"> 
                            <p>Terms available:</p>
                            <p>
                                <input type="checkbox" name="fall" value="fall" 
                                <?php 
                                $checked = substr($depterm, -3, 1);
                                if ($checked == 1) {
                                    echo "checked";
                                }?>>Fall
                                <input type="checkbox" name="spring" value="spring"
                                <?php 
                                $checked = substr($depterm, -2, 1);
                                if ($checked == 1) {
                                    echo "checked";
                                }?>>Spring
                                <input type="checkbox" name="summer" value="summer"
                                <?php 
                                $checked = substr($depterm, -1, 1);
                                if ($checked == 1) {
                                    echo "checked";
                                }?>>Summer
                            </p>
                            <input type="hidden" name="oldTerm" value="<?php echo $depterm; ?>"></input>
                        </fieldset>
                        <tbody>
                    </tbody>
                        <div class ="text-center">
                            <button type="submit" class="btn-lg btn-primary extra-top">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                </div>
            </div>    
            <div class="row text-center extra-top">
                <?php include_once "footer.php" ?>
            </div>
        </div>
    </body>   
</html>




        