<?php
    include('database/database.php'); 
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email    = $_POST['email'];
        $number   = $_POST['number'];
        $password = $_POST['password'];
        $gender   = $_POST['gender'];
        $QRdata = "$username|$email|$number|$password";
        $path   = 'images/';
        $file   = $path . $username . '.png';
        $dup_email = mysqli_query($con, "SELECT * FROM `users` WHERE Email = '$email'");
        if (mysqli_num_rows($dup_email)) {
            echo "
                <script>
                    alert('This email is already taken');
                    window.location.href='Registertion.html';
                </script>";
        } else {
            
            $query = "INSERT INTO `users`(`Name`, `Email`, `Number`, `Password`, `QRpath`, `Gender`)
                        VALUES ('$username', '$email', '$number', '$password', '$file', '$gender')";
            if (mysqli_query($con, $query)) {
                echo "
                <script>
                    alert('Registration successful');
                    window.location.href='attendance_sheet.php';
                </script>";
            } else {
                echo "
                <script>
                    alert('Not successful');
                    window.location.href='Registertion.html';
                </script>";
            }
        }
    }

?>
