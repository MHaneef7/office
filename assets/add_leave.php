<?php 
    include('header.php');
    include('database/database.php');
            $id        = $_SESSION['Id'] ?? '';
            $Name      = $_SESSION['Name'] ?? '';
            $email     = $_SESSION['Email'] ?? ''; 
        if (isset($_POST['save'])) {
            $reason       = mysqli_real_escape_string($con, $_POST['reason']); 
            $leave_form   = mysqli_real_escape_string($con, $_POST['leave_form']);
            $leave_to     = mysqli_real_escape_string($con, $_POST['leave_to']);
            $alternate    = mysqli_real_escape_string($con, $_POST['alternate']);
            $description  = mysqli_real_escape_string($con, $_POST['Desription']);
            $state        = "Pending";
            $start = new DateTime($leave_form);
            $end   = new DateTime($leave_to);
            $diff  = $start->diff($end);
            $totalDays = $diff->days + 1;
            $q = "SELECT Hajj_leaves, Annual_leaves, unpaid_leaves FROM leave_qutta WHERE Id='$id'";
            $res = mysqli_query($con, $q);
            $row = mysqli_fetch_assoc($res);
            $quota = $row['Hajj_leaves'] + $row['Annual_leaves'] + $row['unpaid_leaves'];
            if ($reason == "Hajj") {
                if ($row['Hajj_leaves'] >= $totalDays) {
                    $update = "UPDATE leave_qutta SET Hajj_leaves = Hajj_leaves - $totalDays WHERE Id='$id'";
                    mysqli_query($con, $update);
                } else {
                    echo "<script>alert('Not enough Hajj leaves available');
                        window.location.href = 'add_leave.php';
                    </script>";
                    exit;
                }
            } elseif ($reason == "Annual") {
                if ($row['Annual_leaves'] >= $totalDays) {
                    $update = "UPDATE leave_qutta SET Annual_leaves = Annual_leaves - $totalDays WHERE Id='$id'";
                    mysqli_query($con, $update);
                } else {
                    echo "<script>
                        alert('Not enough Annual leaves available');
                        window.location.href ='add_leave.php'; 
                    </script>";
                    exit;
                }
            } elseif ($reason == "Unpaid") {
                if ($row['unpaid_leaves'] >= $totalDays) {
                    $update = "UPDATE leave_qutta SET unpaid_leaves = unpaid_leaves - $totalDays WHERE Id='$id'";
                    mysqli_query($con, $update);
                } else {
                    echo "<script>alert('Not enough Unpaid leaves available');</script>";
                    exit;
                }
            }
            $sql = "INSERT INTO addleaves
                    (Id, Reason, State, `Leave Form`, LeaveTo, Name, Description, Alternate, `Total leaves days`, `Total leaves Quota`) 
                    VALUES 
                    ('$id','$reason','$state','$leave_form','$leave_to','$Name','$description','$alternate','$totalDays','$quota')";
            if (mysqli_query($con, $sql)) {
                echo "<script>alert('Leave request submitted successfully');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
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


    .leaves:hover{
            background-color: #4b85345e;
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
        border: 1px solid #0000004f;
    }
    .textarea {
        width: 400px;
        height: 150px;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #555;
        border-radius: 5px;
        resize: none;
    }
    .leave_table {
        border-collapse: collapse;
        width: 70%;
        margin-left: 2px;
        font-family: Arial, sans-serif;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    .leave_table th,.leave_table td {
        border: 0px solid #ddd;
        padding: 10px;
        text-align: center;
        color: #333;
    }
    .leave_table th {
        background-color: #155651;
        color: #fff;
        font-weight: bold;
    }

    .leave_table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .leave_table tr:hover {
        background-color: #d4e8d4;
        cursor: pointer;
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
                                    <td><?php echo $_SESSION['Name'];?> </td>
                                </tr>
                                <tr>
                                    <th>Reason</th>
                                    <td>
                                        <select name="reason" id="reasonSelect">
                                            <option value="Hajj">Hajj Leave</option>
                                            <option value="Annual">Annual Leave</option>
                                            <option value="casual">Casual Leave</option>
                                            <option value="Unpaid">Unpaid Leave</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>pending</td>
                                </tr>
                            </table>
                        </div>
                        <?php
                        $query = "SELECT * FROM `leave_qutta` WHERE `Id`='$id'";
                        $result = mysqli_query($con, $query);
                        while ($leave = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="leaves_det">
                            <h2>Employee Leaves Summary</h2>
                            <table class="leave_table">
                                <tr class="leave_menu">
                                    <th class="leave_head">Add leave</th>
                                    <th class="leave_head">Total leave</th>
                                    <th class="leave_head">Apply leave</th>
                                </tr>
                                <tr class="Hajj_leave">
                                    <td>Hajj Leave</td>
                                    <td><?php echo $leave['Hajj_leaves'] ? $leave['Hajj_leaves'] : 0  ; ?></td>
                                    <td>No Data</td>
                                </tr>
                                <tr class="leaves">
                                    <td>Annual Leaves</td>
                                    <td><?php echo $leave['Annual_leaves']; ?></td>
                                    <td>No Data</td>
                                </tr>
                                <tr class="leaves">
                                    <td>Unpaid Leaves</td>
                                    <td><?php echo $leave['unpaid_leaves']; ?></td>
                                    <td>No Data</td>
                                </tr>
                            </table>
                        </div>
                        <?php } ?>
                    </div>
                    
                    <div class="add_leave">
                        <h2>Leave Duration</h2>
                        <table>
                            <tr>
                                <th>Leave Duration:</th>
                                <td>
                                    <select name="duration" id="durationSelect" style="color:red;">
                                        <option value="fullday" style="color:red;">Full Day</option>
                                        <option value="halfday" style="color:red;">Half Day</option>
                                    </select>   
                                </td>
                            </tr>
                            <tr>
                                <th>Leave From:</th>
                                <td>Day: <input type="date" name="leave_form" id="leave_form"></td>
                            </tr>
                            <tr>
                                <th>Leave To:</th>
                                <td>Day: <input type="date" name="leave_to" id="leave_to"></td>
                            </tr>
                            <tr>
                                <th>Leave Days:</th>
                                <td><input type="text" id="leave_days" name="leave_days" readonly></td>
                            </tr>
                        </table>

                        <script>
                            function calculateDays() {
                                let from = document.querySelector('input[name="leave_form"]').value;
                                let to   = document.querySelector('input[name="leave_to"]').value;
                                if (from && to) {
                                    let start = new Date(from);
                                    let end   = new Date(to);   
                                    let diff  = (end - start) / (1000 * 60 * 60 * 24) + 1;
                                    document.getElementById("leave_days").value = diff > 0 ? diff : 0;
                                }
                            }
                            document.querySelector('input[name="leave_form"]').addEventListener("change", calculateDays);
                            document.querySelector('input[name="leave_to"]').addEventListener("change", calculateDays);

                            document.getElementById("reasonSelect").addEventListener("change", function() {
                                let durationSelect = document.getElementById("durationSelect");
                                if (this.value === "casual") {
                                    durationSelect.value = "halfday";
                                } else {
                                    durationSelect.value = "fullday";
                                }
                            });
                        </script>
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
                            <textarea id="note" name="Desription" rows="6" cols="60" required></textarea><br><br>
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
