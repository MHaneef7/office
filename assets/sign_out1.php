<?php

include("database/database.php");
session_start();
date_default_timezone_set("Asia/Karachi");

if (isset($_POST['useremail']) && isset($_POST['userpassword']) && isset($_POST['actionType'])) {
    $useremail = mysqli_real_escape_string($con, $_POST['useremail']);
    $userpassword = mysqli_real_escape_string($con, $_POST['userpassword']);
    $actionType = $_POST['actionType'];

    $query = "SELECT * FROM `table` WHERE `Email` = '$useremail' AND `Password` = '$userpassword'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['Id'] = $user['Id'];
        $_SESSION['Name'] = $user['Name'];
        $_SESSION['Email'] = $user['Email'];
        $_SESSION['QRpath'] = $user['QRpath'];

        $date = date("Y-m-d");
        $datetime = date("Y-m-d H:i:s");
        if ($actionType == "signin") {
            $check = mysqli_query($con, "SELECT * FROM `attendance` WHERE `Email` = '$useremail' AND `Date` = '$date'");
            if (mysqli_num_rows($check) == 0) {
                mysqli_query($con, "INSERT INTO `attendance` (`Id`, `Name`, `Email`, `Sign In`, `Date`, `Total time`) 
                VALUES ('{$user['Id']}', '{$user['Name']}', '{$user['Email']}', '$datetime', '$date', 'Signed In')");
                echo "Sign In Success";
            } else {
                echo "Already Signed In Today!";
            }
        }

        elseif ($actionType == "signout") {
            $check = mysqli_query($con, "SELECT * FROM `attendance` WHERE `Email` = '$useremail' AND `Date` = '$date'");
            if (mysqli_num_rows($check) > 0) {
                $row = mysqli_fetch_assoc($check);
                $signInTime = $row['Sign In'];
                $signOutTime = $datetime;

                $start = strtotime($signInTime);
                $end = strtotime($signOutTime);
                $diff = $end - $start;
                $hours   = floor($diff / 3600);
                $minutes = floor(($diff % 3600) / 60);
                $seconds = $diff % 60;
                $totalTime = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
                mysqli_query($con, "UPDATE `attendance` 
                    SET `Sign Out` = '$signOutTime', `Total time` = '$totalTime'  
                    WHERE `Email` = '$useremail' AND `Date` = '$date'");

                echo " Sign Out Success, Total Time: $totalTime";
            } else {
                echo " No Sign In Found for Today!";
            }
        }
        else {
            echo "Invalid Action Selected!";
        }
    } else {
        echo "Invalid Email or Password";
    }
} else {
    echo "Incomplete Data";
}

// include("database/database.php");

// date_default_timezone_set("Asia/Karachi");

//         if (isset($_POST['useremail']) && isset($_POST['userpassword']) && isset($_POST['actionType'])) {
//             $useremail = mysqli_real_escape_string($con, $_POST['useremail']);
//             $userpassword = mysqli_real_escape_string($con, $_POST['userpassword']);
//             $actionType = $_POST['actionType'];

//             $query = "SELECT * FROM `table` WHERE `Email` = '$useremail' AND `Password` = '$userpassword'";
//             $result = mysqli_query($con, $query);
//             if (mysqli_num_rows($result) > 0) {
//                 $user = mysqli_fetch_assoc($result);

//                 $_SESSION['Id'] = $user['Id'];
//                 $_SESSION['Name'] = $user['Name'];
//                 $_SESSION['Email'] = $user['Email'];
//                 $_SESSION['QRpath'] = $user['QRpath'];

//                 $date = date("Y-m-d");
//                 $datetime = date("Y-m-d H:i:s");

//                 if ($actionType == "signin") {
//                     $check = mysqli_query($con, "SELECT * FROM `attendance` WHERE `Email` = '$useremail' AND `Date`='$date'");
//                     if (mysqli_num_rows($check) == 0) {
//                         mysqli_query($con, "INSERT INTO `attendance` (`Id`, `Name`, `Email`, `Sign In`, `Date`, `Total time`) 
//                         VALUES ('{$user['Id']}', '{$user['Name']}', '{$user['Email']}', '$datetime', '$date', 'Signed In')");
//                         echo "Sign In Success";
//                     } else {
//                         echo "Already Signed In Today!";
//                     }
//                 } elseif ($actionType == "signout") {
//                     $check = mysqli_query($con, "SELECT * FROM `attendance` WHERE `Email` = '$useremail' AND `Date`='$date'");
//                     if (mysqli_num_rows($check) > 0) {
//                         $row = mysqli_fetch_assoc($check);
//                         $signInTime = $row['Sign In'];
//                         $signOutTime = $datetime;
//                         $start = strtotime($signInTime);
//                         $end = strtotime($signOutTime);
//                         $diff = $end - $start;
//                         $hours   = floor($diff / 3600);
//                         $minutes = floor(($diff % 3600) / 60);
//                         $seconds = $diff % 60;
//                         $totalTime = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
//                         mysqli_query ($con, "INSERT `attendance` SET `Sign Out` = '$signOutTime', `Total time` = '$totalTime'WHERE `Email` = '$useremail' AND `Date`='$date'");
//                         echo "Sign Out Success, Total Time: $totalTime";
//                     } else {
//                         echo "No Sign In Found for Today!";
//                     }
//                 } else {
//                     echo "Invalid Action Selected!";
//                 }
//             } else {
//                 echo "Invalid Email or Password";
//             }
//         } else {
//             echo "Incomplete Data";
//         }

// include("database/database.php");
// session_start();
// date_default_timezone_set("Asia/Karachi");

// if (isset($_POST['useremail']) && isset($_POST['userpassword']) && isset($_POST['actionType'])) {
//     $useremail = mysqli_real_escape_string($con, $_POST['useremail']);
//     $userpassword = mysqli_real_escape_string($con, $_POST['userpassword']);
//     $actionType = $_POST['actionType'];
//     $query = "SELECT * FROM `table` WHERE `Email` = '$useremail' AND `Password` = '$userpassword'";
//     $result = mysqli_query($con, $query);

//     if (mysqli_num_rows($result) > 0) {
//         $user = mysqli_fetch_assoc($result);
//         $_SESSION['Id'] = $user['Id'];
//         $_SESSION['Name'] = $user['Name'];
//         $_SESSION['Email'] = $user['Email'];
//         $_SESSION['QRpath'] = $user['QRpath'];
//         $date = date("Y-m-d");
//         $datetime = date("Y-m-d H:i:s");
//         if ($actionType == "signin") {
//             $check = mysqli_query($con, "SELECT * FROM `attendance` WHERE `Email` = '$useremail' AND `Date`='$date'");
//             if (mysqli_num_rows($check) == 0) {
//                 mysqli_query($con, "INSERT INTO `attendance` (`Id`, `Name`, `Email`, `Sign In`, `Date`) 
//                 VALUES ('{$user['Id']}', '{$user['Name']}', '{$user['Email']}', '$datetime', '$date')");
//                 echo "Sign In Success";
//             } else {
//                 echo "Already Signed In Today!";
//             }
//         } elseif ($actionType == "signout") {
//             $check = mysqli_query($con, "SELECT * FROM `attendance` WHERE `Email` = '$useremail' AND `Date`='$date'");
//             if (mysqli_num_rows($check) > 0) {
//                 $row = mysqli_fetch_assoc($check);
//                 $signInTime = $row['Sign In'];

//                 if (!empty($signInTime)) {
//                     $signIn = new DateTime($signInTime);
//                     $signOut = new DateTime($datetime);
//                     $interval = $signIn->diff($signOut);
//                     $totalTime = $interval->format('%H:%I:%S');//:35:20

//                     mysqli_query($con, "UPDATE `attendance` 
//                     SET `Sign Out` = '$datetime', `TotalTime` = '$totalTime' 
//                     WHERE `Email` = '$useremail' AND `Date`='$date'");
//                     echo "Sign Out Success. Total Time: $totalTime";
//                 } else {
//                     echo "Error: No Sign In record found!";
//                 }
//             } else {
//                 echo "No Sign In Found for Today!";
//             }

//         } else {
//             echo "Invalid Action Selected!";
//         }
//     } else {
//         echo "Invalid Email or Password";
//     }
// } else {
//     echo "Incomplete Data";
// }
// include("database/database.php");
// date_default_timezone_set("Asia/Karachi");

// if (isset($_POST['useremail']) && isset($_POST['userpassword']) && isset($_POST['actionType'])) {
//     $useremail = mysqli_real_escape_string($con, $_POST['useremail']);
//     $userpassword = mysqli_real_escape_string($con, $_POST['userpassword']);
//     $actionType = $_POST['actionType'];

//     $query = "SELECT * FROM `table` WHERE `Email` = '$useremail' AND `Password` = '$userpassword'";
//     $result = mysqli_query($con, $query);

//     if (mysqli_num_rows($result) > 0) {
//         $user = mysqli_fetch_assoc($result);
//         $_SESSION['Id'] = $user['Id'];
//         $_SESSION['Name'] = $user['Name'];
//         $_SESSION['Email'] = $user['Email'];
//         $_SESSION['QRpath'] = $user['QRpath'];
//         $date = date("Y-m-d");
//         $datetime = date("Y-m-d H:i:s");
//         if ($actionType == "signin") {
//             $check = mysqli_query($con, "SELECT * FROM `attendance` WHERE `Email` = '$useremail' AND `Date`='$date'");
//             if (mysqli_num_rows($check) == 0) {
//                 mysqli_query($con, "INSERT INTO `attendance` (`Id`, `Name`, `Email`, `Sign In`, `Date`) 
//                 VALUES ('{$user['Id']}', '{$user['Name']}', '{$user['Email']}',  '$datetime', '$date')");
//                 echo "Sign In Success";
//             } else {
//                 echo "Already Signed In Today!";
//             }
//         } elseif ($actionType == "signout") {
//             $check = mysqli_query($con, "SELECT * FROM `attendance` WHERE `Email` = '$useremail' AND `Date`='$date'");
//             if (mysqli_num_rows($check) > 0) {
//                 // sirf Sign Out update hoga
//                 mysqli_query($con, "UPDATE `attendance` SET `Sign Out` = '$datetime' 
//                                     WHERE `Email` = '$useremail' AND `Date`='$date'");
//                 echo "Sign Out Success";
//             } else {
//                 echo "No Sign In Found for Today!";
//             }
//         } else {
//             echo "Invalid Action Selected!";
//         }
//     } else {
//         echo "Invalid Email or Password";
//     }
// } else {
//     echo "Incomplete Data";
// }
// // Example when user clicks Sign Out button
// $userId = $row['Id']; 
// $signOut = date("Y-m-d H:i:s");

// // Update Sign Out
// $updateSignOut = "UPDATE attendance SET `Sign Out`='$signOut' WHERE `UserId`='$userId' AND `Date`=CURDATE()";
// mysqli_query($con, $updateSignOut);

// // Now fetch Sign In


// include("database/database.php");
// date_default_timezone_set("Asia/Karachi");

// if (isset($_POST['useremail']) && isset($_POST['userpassword']) && isset($_POST['actionType'])) {
//     $useremail = mysqli_real_escape_string($con, $_POST['useremail']);
//     $userpassword = mysqli_real_escape_string($con, $_POST['userpassword']);
//     $actionType = $_POST['actionType'];

//     $query = "SELECT * FROM `table` WHERE `Email` = '$useremail' AND `Password` = '$userpassword'";
//     $result = mysqli_query($con, $query);

//     if (mysqli_num_rows($result) > 0) {
//         $user = mysqli_fetch_assoc($result);
//         $_SESSION['Id'] = $user['Id'];
//         $_SESSION['Name'] = $user['Name'];
//         $_SESSION['Email'] = $user['Email'];
//         $_SESSION['QRpath'] = $user['QRpath'];
//         $date = date("Y-m-d");
//         $datetime = date("Y-m-d H:i:s");
//         if ($actionType == "signin") {
//             $check = mysqli_query($con, "SELECT * FROM `attendance` WHERE `Email` = '$useremail' AND `Date`='$date'");
//             if (mysqli_num_rows($check) == 0) {
//                 mysqli_query($con, "INSERT INTO `attendance` (`Id`, `Name`, `Email`, `Sign In`, `Date`) 
//                 VALUES ('{$user['Id']}', '{$user['Name']}', '{$user['Email']}',  '$datetime', '$date')");
//                 echo "Sign In Success";
//             } else {
//                 echo "Already Signed In Today!";
//             }
//         } elseif ($actionType == "signout") {
//             $check = mysqli_query($con, "SELECT * FROM `attendance` WHERE `Email` = '$useremail' AND `Date`='$date'");
//             if (mysqli_num_rows($check) > 0) {
//                 // sirf Sign Out update hoga
//                 mysqli_query($con, "UPDATE `attendance` SET `Sign Out` = '$datetime' 
//                                     WHERE `Email` = '$useremail' AND `Date`='$date'");
//                 echo "Sign Out Success";
//             } else {
//                 echo "No Sign In Found for Today!";
//             }
//         } else {
//             echo "Invalid Action Selected!";
//         }
//     } else {
//         echo "Invalid Email or Password";
//     }
// } else {
//     echo "Incomplete Data";
// }
?>
