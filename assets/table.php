<?php  include('header.php');?>
<?php include('database/database.php');?>
<?php 
?>
<style>
    .box_table{
        margin-left: 203px;
    }
    .container{
        width: 1300px;
    }
    .box {
        height: 80px;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-around;
        align-items: center;
    }
    .select_item {
        width: 180px;
        height: 35px;
        border-radius: 11px;
        font-size: 18px;
        border: 1px solid #ccc;
        padding-left: 9px;
        color: #845b5b;
    }
    .input_search input {
        width: 250px;
        height: 35px;
        border-radius: 13px;
        border: 1px solid #ccc;
        padding-left: 18px;
        padding-right: 19px;
    }
    .box_button  button{        
        background-color:  #343a40;
        padding: 10px 15px;
        color: white;
        border: none;
        border-radius: 25px;
    }
    tr:hover{
        background-color:   #a9aeb6d6;
    }
    .search_table {
        border: 1px solid #ccc;
        border-radius: 15px;
        margin-top: 10px;
        box-shadow: 0px 0px 6px #ccc;
    }

    .noti_box {
        border: 1px solid #ccc;
        margin-top: 10px;
        box-shadow: 0px 0px 6px #ccc;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-end;
        align-items: center;
    }
    .attendance-row tr td {
        font-size: 14px;
        border: 1px solid black;
    }
    .heading_table_row_attendance th {
        background-color: #845b5b7d;
        border: 1px solid black;
    }
    .update {
        background-color: #343a40;
        color: white;
        border: none;
        border-radius: 25px;
        margin-right: -25px;
        width: 65px;
        height: 35px;
    }
    
   .leaves_butn {
        border: none;
        width: 173px;
        text-align: center;
        height: 70px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }
    .leaves_butn button {
        padding: 13px 15px 11px 15px;
        color: white;
        background-color: #343a40;
        border: none;
        border-radius: 10px;
    }
</style>
<div class="box_table">
    <div class="container">
        <div class="main_table">
            <div class="noti_box">  
                <div class="notification">
                    <div class="leaves_butn"> 
                        <a href="add_leave_admin.php">
                            <button type="button">Add leaves</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="search_table">
                <form method="GET">
                    <div class="box">
                        <div  class="input_search">
                            <label><b>Search</b></label><br>
                            <input type="search" placeholder="search" name="Search">
                        </div>
                        <div> <b>Category</b> <br>
                            <select class="select_item" name="category">
                                <option value="All">All</option>
                                <option value="Name">Name</option>
                                <option value="Email">Email</option>
                                <option value="Number">Number</option>
                            </select>
                        </div>
                        <div> <b>Status</b><br>
                            <select class="select_item" name="status">
                                <option value="All">All</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="box_button">
                            <button name="search_button">Submit</button>
                            <button name="delete_all">Delete All</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="search_table">
                <table class="table table-sm"  cellspacing="0" cellpadding="5"Z width="100%">
                    <tr>
                        <th>Id</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Number</th>
                        <th>Password</th>
                 
                        <th>QR path</th>
            
                        <th>Update/Delete</th>
                    </tr>
                    <?php
                        $i = 0;
                        if (isset($_GET['search_button'])) {
                            $search = mysqli_real_escape_string($con , $_GET['Search']);
                            $query = "SELECT * FROM `users` WHERE `Name` LIKE '%$search%' OR `Number` LIKE '%$search%' OR  `Email` LIKE '%$search%'";
                            $data = mysqli_query($con, $query );
                            if (mysqli_num_rows($data)) {
                                while ($row = mysqli_fetch_assoc($data)){
                                    $i++;
                                    $datae = date("h:i:s");
                    ?>
                    <tr> 
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row["Name"];?></td>
                        <td><?php echo $row["Email"];?></td>
                        <td><?php echo $row["Number"];?></td>
                        <td><?php echo $row["Password"];?></td>

                        <td> <img src="<?php echo $row["QRpath"];?>"></td>
                      
                        <td>
                            <div class="box_button">
                                <a href="update.php?id=<?php echo $row['Id']; ?>">
                                    <button type="button">Update</button>
                                </a>
                                <a href="delete.php?id=<?php echo $row['Id']; ?>">
                                    <button type="button" name="delete">Delete</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr class="attendance-row">
                        <td class="table_row"  colspan="9"">
                            <p style="color:blue;"><b>Attendance:</b></p>
                            <table  width="100%" style="margin-top:10px;">
                                <tr class="heading_table_row_attendance">
                                    <th>Date</th>
                                    <th>Sing In</th>
                                    <th>Sign Out</th>
                                    <th>Total Time</th>
                         
                                </tr>
                                <?php
                                    $uid = $row['Id'];
                                    $att_q = "SELECT * FROM `attendance` WHERE `Id`='$uid' ORDER BY Date DESC";
                                    $att_data = mysqli_query($con, $att_q);
                                    if(mysqli_num_rows($att_data)>0){
                                        while($att = mysqli_fetch_assoc($att_data)){
                                ?>
                                <tr>
                                    <td><?php echo $att["date"];?></td>
                        <td>
                            <?php  
                                if ($att["sign_in"] !== null && $att["sign_in"] !== "0000-00-00 00:00:00") {
                                    echo $att["sign_in"];
                                } else {
                                    echo "------ ------";
                                }
                            ?>
                        </td>                
                        <td>
                            <?php 
                                if ($att["sign_out"] !== null && $att["sign_out"] != "0000-00-00 00:00:00") {
                                    echo $att["sign_out"];
                                } else {
                                    echo "------ -----";
                                }
                            ?>
                        </td>
                        <td><?php echo $att['total_time'];?></td>    
                                    <?php } } else { ?>
                                        <tr><td colspan="7">No Attendance Found</td></tr>
                                        <?php } ?>     
                                    </table>
                        </td>
                    </tr>
                    <?php
                            }
                        } else {
                    ?>
                  
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
