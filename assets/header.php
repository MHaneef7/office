<?php
    include('database/database.php');
    session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title> M G F Project </title>
     <style>
        .image_logo img {
            width: 180px;
            height: 90px;
            margin-top: -21px;
        }
        .nev_bar {
            width: 100%;
            color: #343a40;
            margin-top: -12px;
            position: sticky;
            background: white;
            top: 0px;
        }
        .navbar .nav-link {
            color: black  !important; 
        }
        .navbar .navbar-brand {
            color: black !important; 
        }
        .circle_input img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: lightblue;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
        #fileInput {
            display: none;
        }
        .icon  {
            margin-left: -43px;
            width: 77px;
            text-align: center;
            margin: 10px;
        }
        #icon_QR {
            font-size: 56px;
            color:#343a40 ;
        }   
        .user_name {
            color:#343a40;
            font-weight: bold;
            margin-right: 15px;
        }
        .QR_img img{
            width: 102px;
            height: 12px;
            border: 3px solid width;
        }
        .mysidebar {
            position: fixed;
            background-color: #343a40;
            left: 0;
            height: 102vh;
            width: 200px;
            top: 98px;
            bottom: 0;
            padding-top: 16px;
            margin-top: 11px;
        }
        .mysidebar ul{
            margin: 0;
            padding: 0;
        }
        .mysidebar li a {
            display: block;
            padding: 15px 18px;
            text-transform: capitalize;
            text-decoration: none;
        }
        .mysidebar li a{
            color: white;
        }
    </style>
</head>
<body>
    <div class="nev_bar">
        <nav class="navbar navbar-expand-lg navbar-light" >
            <div class="container-fluid">
                <div class="image_logo">
                    <img src="image/logo.png">
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" 
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="color: #343a40;">
                        <li class="nav-item"><a class="nav-link active" href="#"><b>Home</b></a></li>
                        <li class="nav-item"><a class="nav-link active" href="#"><b>Object</b></a></li>
                        <li class="nav-item"><a class="nav-link active" href="#"><b>Registration Form</b></a></li>
                        <li class="nav-item"><a class="nav-link active" href="attendance_sheet.php"><b>Attendance Page</b></a></li>
                        <li class="nav-item"><a class="nav-link active" href="login.html"><b>Login</b></a></li>
                    </ul>
                    <?php  if(isset($_SESSION['Name'])) { ?>
                        <span class="user_name"><?php  echo $_SESSION['Name']; ; ?></span>
                    <?php }  ?>
                      
                    <div class="circle_input" onclick="document.getElementById('fileInput').click()">
                        <img src="image/images.jpeg">
                    </div>
                    
                    <form method="POST">
                        <input type="file" id="fileInput" onchange="displayFileName()">
                    </form>
                    <div class="icon">
                        <a href="QR_image.php"><i id="icon_QR" class="fa fa-qrcode"></i></a>
                    </div>
                </div>
            </div>
        </nav>
        <hr>
    </div>
     <div class="mysidebar">
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Employee</a></li>
                <li><a href="leave_table.php">leave</a></li>
                <li><a href="attendance_sheet.php">Mark Attendance</a></li>
                <li><a href="add_leave.php">Apply for a leave</a></li>
                <li><a href="leave_Quota.php">leave Qutta</a></li>
            </ul>
        </div>
    <script>
        function displayFileName() {
            const fileInput = document.getElementById('fileInput');
            if (fileInput.files.length) {
                alert("Selected file: " + fileInput.files[0].name);
            }
        }
    </script>

