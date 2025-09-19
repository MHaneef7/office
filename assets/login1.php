<?php 
session_start(); 
include('database/database.php');
    if (isset($_POST['login'])) {
        $useremail = $_POST['useremail'];
        $userpassword = $_POST['userpassword'];   
        if ($useremail === "admin@gmail.com" && $_POST['userpassword'] === "admin123") {
            $_SESSION['Name'] = "admin";
            $_SESSION['Name'] = "Admin";
            $_SESSION['Email'] = $useremail;
            echo "
            <script>
                alert('Welcome Admin');
                window.location.href='table.php';
            </script>";
            exit();
        }
        $result = mysqli_query($con, "SELECT * FROM `users` WHERE `Email` = '$useremail' AND Password = '$userpassword'");
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result); 
            $_SESSION['Id'] = $row['Id'];
            $_SESSION['Name'] = $row['Name'];
            $_SESSION['Email'] = $row['Email'];
            echo "
            <script>
                alert('Login Success');
                window.location.href='attendance_sheet.php';
            </script>";
            exit();
        } else {
            echo "
            <script>
                alert('Invalid credentials. Please try again.');
                window.location.href='login.html';
            </script>";
            exit();
        }
    }
?>