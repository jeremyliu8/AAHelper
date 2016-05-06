<!DOCTYPE html>
<?php 
    session_start();

    //open database
    require_once 'includes/db_connect.php';
    require_once 'includes/functions.php';

    if (!logged_in() || !isset($_SESSION['advid'])) {
        header("Location: index.php");
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $_SESSION['fname'] . " " . $_SESSION['lname'] ?> | Home</title>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/main.css"/>

        <script   src="https://code.jquery.com/jquery-1.12.3.js"   integrity="sha256-1XMpEtA4eKXNNpXcJ1pmMPs8JV+nwLdEqwiJeCQEkyc="   crossorigin="anonymous"></script>
        <script src="js/jquery.searchable-1.1.0.min.js"></script>
        <script src="js/searchable.js"></script>

    </head>
    <body>
        <nav class="navbar navbar-default navbar-custom">
            <div class="container-fluid"> 
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"></button>
                    <a class="navbar-brand" href="advisor_home.php">Advisor</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li> </li>
                        <li> </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="advisor_home.php">
                        <?php   
                            echo $_SESSION['fname'];
                            echo " ";
                            echo $_SESSION['lname']; 
                        ?>
                        </a></li>
                        <li>&nbsp;</li>
                        <li><a><?php echo $_SESSION['advid']; ?></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row text-center extra-top">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <input type="search" id="search" value="" class="form-control" placeholder="Search Classes...">
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row extra-top overflowing">
                        <table id="studentList" class="table">
                            <thead> 
                                <tr>
                                    <th>Course ID</th>
                                    <th>Class Name</th>
                                    <th>Units</th>
                                    <th>Term</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require_once 'includes/functions.php';
                                    require_once 'includes/db_connect.php';

                                    $array = "SELECT * 
                                             FROM courses";
                                    $result = $connection->query($array);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $courseid = $row['courseid'];
                                            $classname = $row['classname'];
                                            $units = $row['units'];
                                            $term = $row['term'];
                                            $delete = "delete";
                                            echo "<tr>";
                                            echo "<td><a class='logout' href=coursenext.php?courseid=",urlencode($courseid),">$courseid</a></td>";
                                            echo "<td>$classname</td>";
                                            echo "<td>$units</td>";
                                            echo "<td>$term</td>";
                                            echo "<td><a class='logout' href=deleteCourse.php?courseid=",urlencode($courseid),">delete</a></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    $connection->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row text-left extra-top">
                        <a class="btn-lg btn-primary" href="add_class.php">Add Class!</a>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row extra-top">
                <div class="text-center">
                    <a href="includes/logout.php" class="logout">Logout</a>
                </div>
            </div>
        </div>       
             <!-- include footer -->
        <center>
          <?php include 'footer.php'; ?>
        </center>

    </body>
</html>








