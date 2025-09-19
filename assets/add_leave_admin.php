<?php 
    include('header.php');
    include('database/database.php');
    $notiQuery = "SELECT COUNT(*) as total FROM `addleaves` WHERE `State`='Pending'";
    $notiResult = mysqli_query($con, $notiQuery);
    $notiRow = mysqli_fetch_assoc($notiResult);
    $totalNoti = $notiRow['total'] ?? 0;
        if (isset($_GET['action']) && isset($_GET['leave_id'])) {
            $leave_id = intval($_GET['leave_id']);
            $action   = $_GET['action'];
            $empQuery = mysqli_query($con, "SELECT Id, Name FROM addleaves WHERE id='$leave_id'");
            $empData  = mysqli_fetch_assoc($empQuery);
            $empId    = $empData['Id'] ?? 0;
            if ($action == "accept") {
                $update = "UPDATE `addleaves` SET `State`='Approved' WHERE `id`='$leave_id'";
                $msg    = "Your leave request has been Approved by Admin.";
            } elseif ($action == "reject") {
                $update = "UPDATE `addleaves` SET `State`='Rejected' WHERE `id`='$leave_id'";
                $msg    = "Your leave request has been Rejected by Admin.";
            }
            if (mysqli_query($con, $update)){
                if ($empId > 0) {
                    $insertNoti = "INSERT INTO notifications (employee_id, message) VALUES ('$empId', '$msg')";
                    mysqli_query($con, $insertNoti);
                }
                echo "<script>alert('Leave updated successfully'); window.location='add_leave_admin.php';</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
            }
        }
?>
<style> 
    .leave_main{
        margin-left: 203px;
        padding-left: 19px;
    }
    tr th{
        background-color: #343a40;
        color: wheat;
    }
    tr:hover{
        background-color: #00000065;
        color: black;
    }
    td button{
        background-color: #343a40;
        color: #f7f2e9;
        padding: 6px 20px;
        border-radius: 25px;
        border: none;
        cursor: pointer;
    }
    .search_box {
        width: 100%;
        display: flex;
        justify-content: space-between;
        height: 65px;
        align-items: center;
    }
    .search_input {
        width: 480px;
        height: 55px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        background-color: #dddde145;
    }
    .search_box input {
        width: 312px;
        height: 42px;
        border-radius: 5px;
        padding-left: 10px;
        border: 3px solid black;
    }
    .search_button button {
        width: 120px;
        height: 45px;
        border-radius: 5px;
        background-color: #343a40;
        color: white;
        border: none;
        cursor: pointer;
    }
    .notification_box {
        width: 100px;
        height: 69px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .noti_logo img {
        width: 35px;
        height: 35px;
    }
    .total_msg {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: red;
        color: white;
        text-align: center;
        margin-bottom: 35px;
        margin-left: -15px;
        font-size: 14px;
        line-height: 24px;
    }
</style>
<div class="leaves_modul">
    <div class="leave">
        <div class="container">
            <div class="leave_main">
                <table class="table table-sm bg-black">
                    <tr>
                        <form  method="GET">    
                            <div class="search_box"> 
                                <div class="search_input">
                                    <input type="text" name="Search" placeholder="Search">
                                    <div class="search_button"> 
                                        <button type="submit" name="search_button">Search</button>
                                    </div>
                                </div>
                                <div class="notification_box">
                                    <div class="noti_logo">
                                        <img src="image/msg_logo.png">
                                    </div>
                                    <div class="total_msg">
                                        <span><b><?php echo $totalNoti; ?></b></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </tr>
                    <tr style="background-color: #343a40;">
                        <th>#No</th>
                        <th>Name</th>
                        <th>Reason</th>
                        <th>State</th>
                        <th>Leave From</th>
                        <th>Leave To</th>
                        <th>Description</th>
                        <th>Alternate</th>
                        <th>Action</th>
                    </tr>
                        <?php
                                $query = "SELECT * FROM `addleaves` ORDER BY id DESC";
                                if (isset($_GET['search_button'])) {
                                    $search = mysqli_real_escape_string($con , $_GET['Search']);
                                    $query = "SELECT * FROM `addleaves` 
                                            WHERE  `Id` LIKE '%$search%' OR `Name` LIKE '%$search%' ";
                                }
                                $result = mysqli_query($con,  $query );
                                if (mysqli_num_rows($result) > 0) {
                                    $id = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $id++;?></td>
                            <td><?php //echo $row['name'];?></td>
                            <td><?php echo $row['reason'];?></td>
                            <td><?php echo $row['state'];?></td>
                            <td><?php echo $row['leave_from'];?></td>
                            <td><?php echo $row['leave_to'];?></td>
                            <td><?php echo $row['description'];?></td>
                            <td><?php echo $row['alternate'];?></td>
                            <td> 
                                <button>Accept</button>
                                <button>Reject</button>
                            </td>
                        </tr>
                    <?php
                            }
                        } else {
                            echo "<tr><td colspan='9' style='text-align:center;'>No leave requests found</td></tr>";
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>