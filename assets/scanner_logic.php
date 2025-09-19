<?php
include('database/database.php');
if (isset($_POST['actionType']) && $_POST['actionType'] === "qrLogin") {
    $useremail = mysqli_real_escape_string($con, $_POST['useremail']);
    $userpassword = mysqli_real_escape_string($con, $_POST['userpassword']);

    if ($useremail === "admin@gmail.com" && $userpassword === "admin123") {
        $_SESSION['Id'] = "admin";
        $_SESSION['Name'] = "Admin";
        $_SESSION['Email'] = $useremail;
        echo "success"; 
        exit();
    }

    $result = mysqli_query($con, "SELECT * FROM `table` WHERE Email = '$useremail' AND Password = '$userpassword'");

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['Id'] = $row['Id'];
        $_SESSION['Name'] = $row['Name'];
        $_SESSION['Email'] = $row['Email'];
        $_SESSION['Password'] = $row['Password'];

        echo "success";
    } else {
        echo "Invalid credentials!";
    }
}
?>
