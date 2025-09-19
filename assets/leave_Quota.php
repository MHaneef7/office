<?php include('header.php');?>
<?php 
include('database/database.php');
?>
<?php
if (isset($_POST['save'])) {
    $Id   = (int) $_POST['Id'];
    $hajj_leaves   = (int) $_POST['Hajj_leaves'];
    $annual_leaves = (int) $_POST['Annual_leaves'];
    $unpaid_leaves = (int) $_POST['unpaid_leaves'];
    $empResult = mysqli_query($con, "SELECT `Name` FROM `users` WHERE `Id` = $Id");
    $empRow = mysqli_fetch_assoc($empResult);

    if ($empRow) {
        $name = $empRow['Name'];
        $checkQuota = mysqli_query($con, "SELECT * FROM `leave_qutta` WHERE `Id` = $Id");
        if (mysqli_num_rows($checkQuota) > 0) {
            $update = "UPDATE `leave_qutta` SET `Hajj_leaves`='$hajj_leaves', `Annual_leaves`='$annual_leaves', `unpaid_leaves`='$unpaid_leaves', `Name`='$name' WHERE `Id`='$Id'";
            if (mysqli_query($con, $update)) {
                echo "<p style='color:blue; font-weight:bold;'>Quota Updated Successfully</p>";
            } else {
                echo "<p style='color:red; font-weight:bold;'>Error: " . mysqli_error($con) . "</p>";
            }
        } else {
            $insert = "INSERT INTO `leave_qutta`
                (`Hajj_leaves`, `Annual_leaves`, `unpaid_leaves`, `Id`, `Name`) VALUES ('$hajj_leaves','$annual_leaves','$unpaid_leaves','$Id','$name')";
            if (mysqli_query($con, $insert)) {
                echo "<p style='color:green; font-weight:bold;'>Quota Added Successfully</p>";
            } else {
                echo "<p style='color:red; font-weight:bold;'>Error: " . mysqli_error($con) . "</p>";
            }
        }
    } else {
        echo "<p style='color:red; font-weight:bold;'>Employee not found!</p>";
    }
}
?>
<style>
   .leave_qutta {
        border: 0px solid black;
        margin-left: 236px;
        width: 80%;
        padding: 20px;
    }
    .leave_qutta_inp {
        margin-bottom: 15px;
    }
    .leave_qutta_inp label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .leave_qutta_inp input {
        width: 400px;
        border: 1px solid black;
        height: 40px;
        padding-left: 10px;
    }
    .leave_qutta_inp select {
        width: 420px;
        border: 1px solid black;
        height: 45px;
    }
    .btn-save {
        background-color: #343a40;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
    }
</style>
<div class="leave_qutta">
    <h2>Leave Quota to Employee</h2>
    <form method="POST">
        <div class="leave_qutta_inp">
            <label>Select Employee</label>
            <select name="Id" required>
                <option value="">Select Employee</option>
                 <?php
                    $sql = "SELECT `Id`, `Name` FROM `users`";   
                    $result = mysqli_query($con, $sql);
                    if ($result && mysqli_num_rows($result)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['Id'] . "'>" . $row['Name'] . "</option>";
                        }
                    }
                ?>
            </select>
        </div>
        <div class="leave_qutta_inp">
            <label>Hajj Leaves</label>
            <input type="number" name="Hajj_leaves" required>
        </div>

        <div class="leave_qutta_inp">
            <label>Annual Leaves</label>
            <input type="number" name="Annual_leaves" required>
        </div>

        <div class="leave_qutta_inp">
            <label>Unpaid Leaves</label>
            <input type="number" name="unpaid_leaves" required>
        </div>
        <button type="submit" name="save" class="btn-save">Save Quota</button>
    </form>
</div>
