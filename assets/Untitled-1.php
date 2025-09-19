
session_start();

if (isset($_POST['save'])) {
    $leave_form = $_POST['leave_form'];
    $leave_to   = $_POST['leave_to'];
    $leave_type = $_POST['leave_type'];
    $reason     = $_POST['reason'];
    $description = $_POST['description'];
    $userId     = $_SESSION['Id']; 

    $sql = "INSERT INTO leaves (EmployeeName, Reason, State, Leave To:, LeaveDays description, status) 
            VALUES ('$userId', '$leave_type', '$reason', '$leave_form', '$leave_to', '$description', 'Pending')";

    if (mysqli_query($con, $sql)) {
        echo "<script>
                alert('Leave request submitted successfully');
                window.location.href='leaves.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($con) . "');
              </script>";
    }
}

   $leave_form = $_POST['leave_form'];
    $leave_to   = $_POST['leave_to'];
    $leave_type = $_POST['leave_type'];
    $reason     = $_POST['reason'];
    $userId     = $_SESSION['Id']; 
    $sql = "INSERT INTO leaves (EmployeeName, Reason, State, Leave To:, LeaveDays ) 
            VALUES ('$userId', '$leave_type', '$reason', '$leave_form', '$leave_to', '$description', 'Pending')";

    if (mysqli_query($con, $sql)) {
        echo "<script>
                alert('uccessfully');
                window.location.href='leaves.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($con) . "');
              </script>";
    }
    <?php 
//include('header.php');
include('database/database.php');

$id  = $_SESSION['Id'] ?? '';
$Name  = $_SESSION['Name'] ?? '';
$email = $_SESSION['Email'] ?? ''; 
if (isset($_POST['save'])) {
    $leave_form   = mysqli_real_escape_string($con, $_POST['leave_form']);
    $leave_to     = mysqli_real_escape_string($con, $_POST['leave_to']);
    $reason       = mysqli_real_escape_string($con, $_POST['reason']);
    $alternate    = mysqli_real_escape_string($con, $_POST['alternate']);
    $description  = mysqli_real_escape_string($con, $_POST['description']);
    $state        = "Pending"; 

    $sql = "INSERT INTO `addleaves`(`Id`, `Reason`, `State`, `Leave Form`, `LeaveTo`,`Name`,`Description` , `Alternate`) 
            VALUES ('$id', '$reason', '$state', '$leave_form', '$leave_to', '$Name', '$description', $alternate )";

    if (mysqli_query($con, $sql)) {
        echo "<script>
                alert('Leave request submitted successfully');
              </script>";
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($con) . "');
              </script>";
    }
}
?>
<style>
    .leaves_modul{
        margin-left: 203px;
    }
    .module_leave_main {
    
        padding-left: 19px;
    }
    .add_leave{
        width: 120px;
    }
    .add_leave_information {
        width: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: space-between;
    }
    .leaves_information {
        width: 599px;
        height: 261px;
        padding-top: 20px;
    }

    .add_leave {
        width: 599px;
        border: none;
        padding-top: 30px;
    }
    table {
        border-collapse: collapse;
        margin-top: 10px;
    }
    th, td {
        border: none;
        padding: 10px;
        text-align: left;
        width: 260px;
    }
    
    .leaves_det {
        width: 554px;
        height: 149px;
        border: none;
        margin-right: 18px;
    }

    .Hajj_leave, .leaves {
        width: 450px;
        border: 1px solid #02020253;
        height: 34px;
        padding: 5px;
        color: #000000bd;
        
    }
    .leaves:hover{
            background-color: #4b85345e;
    }
    .Hajj_leave {
        border: 1px solid #00000078;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-between;
        background-color: #1556515e;
        color: #000000bd;
    }

    .Description_msg input {
        width: 500px;
        height: 200px;
    }
    .select{
            width: 500px;
        height: 200px;
    }
    .save_btn {
        width: 100%;
        display: flex;
        justify-content: center;
        height: 130px;
        align-items: center;
        align-content: center;
    }
    .save_btn button {
        padding: 20px 70px 20px 70px;
        font-size: 21px;
        border: none;
        background-color: #343a40;
        color: white;
        border-radius: 50px;
    }
    td select {
        width: 241px;
        border: 1px solid #00000008;
        border-bottom-color: black;
    }
    td input {
        width: 200px;
        height: 35px;
        border: none;
    }
    textarea {
        width: 400px;
        height: 150px;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #555;
        border-radius: 5px;
        resize: none; /* user resize na kar sake */
    }



</style>
<div class="leaves_modul">
    <div class="module_leave">
        <div class="container">
            <div class="module_leave_main">
                <form method="POST" action="">
                    <div class="add_leave_information">
                        <div class="leaves_information">
                            <h2> Leave Information </h2>
                            <table>
                                <tr>
                                    <th>Employee</th>
                                    <td><?php echo$_SESSION['Name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Leave Type Title</th>
                                    <td>
                                        <select name="actionType"">
                                            <option value="Annual">Annual Leave</option>
                                            <option value="Unpaid">Unpaid Leave</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Reason</th>
                                    <td>
                                        <select name="reason">
                                            <option value="Annual">Annual Leave</option>
                                            <option value="Unpaid">Unpaid Leave</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>Approved</td>
                                </tr>
                            </table>
                        </div>
                        <div class="leaves_det">
                            <h2>Employee Leaves Summary</h2>
                            <div class="Hajj_leave"><p>Hajj leave</p> <p>44</p> <p>88.9</p></div>
                            <div class="leaves">Annual leaves</div>
                            <div class="leaves">Unpaid leaves</div>
                        </div>
                    </div>
                    <div class="add_leave">
                        <h2>Leave Duration</h2>
                        <table>
                            <tr>
                                <th>Leave Duration:</th>
                                <td>
                                    <select name="duration">
                                        <option value="Annual">Annual leave</option>
                                        <option value="Unpaid">Unpaid leave</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Leave From:</th>
                                <td>Day: <input type="date" name="leave_form"></td>
                            </tr>
                            <tr>
                                <th>Leave To:</th>
                                <td>Day: <input type="date" name="leave_to"></td>
                            </tr>
                            <tr>
                                <th>Leave Days:</th>
                                <td>9.00</td>
                            </tr>
                        </table>
                    </div>
                    <div class="add_leave">
                        <h2>Alternate</h2>
                        <table>
                            <tr>
                                <th>Alternate Employee:</th>
                                <td><input type="text" name="alternate"></td>
                            </tr>
                            <tr>
                                <th>Leave From:</th>
                                <td>---- -----</td>
                            </tr>
                        </table>
                    </div>
                    <div class="add_leave">
                        <h2>Leave Description</h2>
                        <div class="Description_msg">
                                <textarea id="note" name="description" rows="6" cols="60" required></textarea><br><br>
                        </div>
                    </div>
                    <div class="save_btn">
                        <button type="submit" name="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
// $result = mysqli_query($con, "SELECT * FROM leaves");
// while ($row = mysqli_fetch_assoc($result)) {
//     echo "<tr>";
//     echo "<td>".$row['user_id']."</td>";
//     echo "<td>".$row['leave_from']."</td>";
//     echo "<td>".$row['leave_to']."</td>";
//     echo "<td>".$row['reason']."</td>";
//     echo "<td>".$row['status']."</td>";

//     if ($row['status'] == 'Pending') {
//         echo "<td>
//                 <a href='approve.php?id=".$row['id']."&action=approve'>Approve</a> | 
//                 <a href='approve.php?id=".$row['id']."&action=reject'>Reject</a>
//               </td>";
//     } else {
//         echo "<td>".$row['status']."</td>";
//     }

//     echo "</tr>";
// }

?>
<?php
//include('database/database.php');

// if (isset($_GET['id']) && isset($_GET['action'])) {
//     $id = intval($_GET['id']);
//     $action = $_GET['action'];

//     if ($action == "approve") {
//         $status = "Approved";
//     } elseif ($action == "reject") {
//         $status = "Rejected";
//     } else {
//         $status = "Pending";
//     }

//     $query = "UPDATE leaves SET status='$status' WHERE id=$id";
//     mysqli_query($con, $query);

//     header("Location: admin_leaves.php"); // redirect back
//     exit();
// }
// CREATE TABLE leave_quota (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     employee_id INT NOT NULL,
//     hajj_leaves INT DEFAULT 0,
//     annual_leaves INT DEFAULT 0,
//     unpaid_leaves INT DEFAULT 0,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
//      );
//     $employee_name = $empRow['Name'];
//    $sql = "SELECT `Id`, `Name` FROM `table`";   
//    $result = mysqli_query($con, $sql);
?>