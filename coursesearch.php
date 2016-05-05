<div class="row text-center extra-top">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input type="search" id="search" value="" class="form-control" placeholder="Search for your students">
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row extra-top">
                <table id="studentList" class="table">
                    <thead> 
                        <tr>
                            <th>Student ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>major</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once 'includes/functions.php';
                            require_once 'includes/db_connect.php';

                            $array = "SELECT * 
                                     FROM student";
                            $result = $connection->query($array);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $fname = $row['fname'];
                                    $lname = $row['lname'];
                                    $studentid = $row['studentid'];
                                    $major = $row['major'];
                                    echo "<tr>";
                                    echo "<td><a class='link' href=advisor_form.php?studentid=",urlencode($studentid),">$studentid</a></td>";
                                    echo "<td>$fname</td>";
                                    echo "<td>$lname</td>";
                                    echo "<td>$major</td>";
                                    echo "</tr>";
                                }
                            }
                            $connection->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>