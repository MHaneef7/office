<?php 
include('header.php');
include('database/database.php');
$Id = $_SESSION['Id'];
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
    .status {
        border: 0px solid black;
        text-align: center;
        width: 90px;
        height: 30px;
        background-color: red;
        color: white;
        text-decoration: dotted;
        font-style: oblique;
        border-radius: 15px;
        text-align: center;
        padding: 4px;
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
                                        <span><b><?php echo "1"; ?></b></span>
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
                        <th>Total leaves days</th>
                        <th>Total leaves Quota</th>
                        <th>Description</th>
                        <th>Alternate</th>
                        <th>Approval Status</th>
                    </tr>
                    <?php
                        $query = "SELECT * FROM `addleaves` WHERE `id`='$Id' ORDER BY `id` DESC ";       
                        $result = mysqli_query($con,  $query );
                        $id =1;
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $id++;?></td>
                            <td><?php echo $row['Name'];?></td>
                            <td><?php echo $row['Reason'];?></td>
                            <td><?php echo $row['State'];?></td>
                            <td><?php echo $row['Leave Form'];?></td>
                            <td><?php echo $row['LeaveTo'];?></td>
                            <td style = "text-align:center;"><?php echo $row['Total leaves Quota'];?></td>
                            <td style = "text-align:center;"><?php echo $row['Total leaves days'];?></td>
                            <td><?php echo $row['Description'];?></td>
                            <td><?php echo $row['Alternate'];?></td>
                            <td> 
                              <div class="status">z`
                                <p>Pending</p>
                              </div>
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