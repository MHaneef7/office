 <?php // include('header.php');?> 
 <?php include('database/database.php');?> 
<?php
session_start();

if (isset($_POST['save'])) {
    echo "<script>console.log('Right');</script>";
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
    
        .Hajj_leave , .leaves {
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

       .Description input {
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

    </style>
    <div class="leaves_modul">
        <div class="module_leave">
            <div class="container">
                <div class="module_leave_main">
                    <div class="add_leave_information">
                        <div class="leaves_information">
                                <h2> Leave Information </h2>
                                <table >
                                    <tr>
                                        <th>Employee</th>
                                          <td><?php $_SESSION['Name']; ?></td>      
                                            </tr>
                                    <tr>
                                        <th>Leave Type Title</th>
                                        <td><select>
                                                <option>Annual Leave</option>
                                                <option>Annual Leave</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <th>Reason</th>
                                        <td><select>
                                                <option>Annual Leave</option>
                                                <option>Annual Leave</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>Approved</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="leaves_det">
                                <h2>Employee Leaves Summary</h2>
                                <div class="Hajj_leave"><p>Hajj leave </p> <p> 44 </p> <p>88.9</p></div>
                                <div class="leaves">Annual leaves</div>
                                <div class="leaves">unpaid leaves</div>
                            </div>
                    </div>
                    <div class="add_leave">
                        <h2> Leave Duration</h2>
                            <table >
                            <tr>
                                    <th> Leave Duration:</th>
                                    <td><select>
                                        <option>Annual leave</option>
                                        <option>unpaid leave</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <th>Leave Form:</th>
                                    <td>Day : <input type="Date" name="leave_form" ></td>
                                </tr>
                                <tr>
                                    <th>Leave To:</th>
                                    <td>Day : <input type ="Date" name="leave_to" ></td>
                                </tr>
                                <tr>
                                    <th>Leave Days:</th>
                                    <td>9.00</td>
                                </tr>
                            </table>
                        </div>
                        <div class="add_leave">
                            <h2>Alternate</h2>
                                <table >
                                    <tr>
                                        <th>Alternate Employee:</th>
                                        <td>Admin</td>
                                    </tr>
                                    <tr>
                                        <th>Leave From:</th>
                                        <td>-----------</td>
                                    </tr>
                                </table>
                        </div>
                        <div class="add_leave">
                            <h2>Leave Description</h2>
                                <div class="Description">
                                    <input type="text">
                                </div>
                        </div>
                    <div class="save_btn">
                   <button  name="save" >save</button>
                                                
                        <script>
                
                            // function save(){
                            //        alert("jkasdlfj");
                            // }
                            </script>
                    </div>
                   
                </div>
            </div>
        </div>