<?php 
    include('header.php');
    include('database/database.php');
    $Id = $_SESSION['Id'] ?? 0;
?>
<style>
    .container {
        width: 1310px;
        margin: auto;
    }
    .main_table {
        margin-left: 200px;
    }
    tr, th {
        background-color: #343a40;
        color: wheat;
    }
    tr:hover {
        background-color: #00000065;
        color: black;
    }
    .heading h2 {
        margin: 20px 0;
        font-weight: bold;
    }
</style>

<div class="box_attendance">  
    <div id="box_table">
        <div class="container">
            <div class="main_table">
                <div class="heading">
                    <h2>Attendance Records</h2>
                </div>
                <div class="search_table">
                    <table class="table table-sm bg-black table-bordered text-center">
                        <thead>
                            <tr style="background-color: #343a40;">
                                <th>#No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Sign In</th>
                                <th>Sign Out</th>
                                <th>Total Time</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if ($Id > 0) {
                                $query = "SELECT * FROM `attendance` WHERE `Id` = '$Id' ORDER BY `Date` DESC";
                                $result = mysqli_query($con, $query);
                                $i = 1;

                                if (mysqli_num_rows($result) > 0) {
                                    while ($att = mysqli_fetch_assoc($result)) {
//                                         <!-- CREATE TABLE attendance (
//     Id INT AUTO_INCREMENT PRIMARY KEY,
//     Name VARCHAR(250) NOT NULL,
//     Email VARCHAR(250) NOT NULL,
// 	 SignIn DateTIME NOT NULL,
//     SignOut DateTIME DEFAULT NULL,
//     TotalTime TIME GENERATED ALWAYS AS (TIMEDIFF(SignOut, SignIn)) STORED
// Date Date NOT NULL AFTER Name
// ); -->
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo htmlspecialchars($att["Name"]); ?></td> 
                                            <td><?php echo htmlspecialchars($att["Email"]); ?></td> 
                                            <td><?php echo $att["Date"]; ?></td>
                                            <td>
                                                <?php  
                                                    if (!empty($att["SignIn"]) && $att["SignIn"] != "0000-00-00 00:00:00") {
                                                        echo $att["SignIn"];
                                                    } else {
                                                        echo "------ ------";
                                                    }
                                                ?>
                                            </td>                
                                            <td>
                                                <?php 
                                                    if (!empty($att["SignOut"]) && $att["SignOut"] != "0000-00-00 00:00:00") {
                                                        echo $att["SignOut"];
                                                    } else {
                                                        echo "------ ------";
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $att['TotalTime'] ?? "--:--"; ?></td>    
                                        </tr>
                                        <?php
                                            $i++;
                                            }
                                            } else {
                                                echo "<tr><td colspan='7'>No attendance records found</td></tr>";
                                            }
                                            } else {
                                                echo "<tr><td colspan='7'>Invalid session. Please log in again.</td></tr>";
                                            }
                                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
