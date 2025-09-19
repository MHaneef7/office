<?php
include('database\database.php');


if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = mysqli_query($con, "SELECT * FROM `users` WHERE `Id`='$id'");
  $row = mysqli_fetch_assoc($result);
  $name = $row['Name'];
  $email = $row['Email'];
  $number = $row['Number'];
  $password = $row['Password'];
} 


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <div class="header">
        <div class="container">
          <div class="main">
            <div class="page_1">
              <div class="image_logo">
                <img src="image/logo.png">
              </div>
                <div class="registration_form">
                  <form  method="POST">
                    <div class="input_box">
                      <input type="text" name="username" value="<?php echo $name; ?>"  required>
                    </div>
                  <div class="input_box">
                    <input type="email" name="email" value="<?php echo $email; ?>" required>
                  </div>  
                  <div class="input_box">
                    <input type="number" name="number" value="<?php echo $number; ?>" required>
                  </div>
                  <div class="input_box">
                    <input type="password" name="password" value="<?php echo $password; ?>" required>
                  </div>
                  <div class="form_button">
                    <button type="submit" name="submit">Update</button>
                  </div>
                </form>
            </div>
        </div>
      </div>
    </div>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
  $name = $_POST['username'];
  $email = $_POST['email'];
  $number = $_POST['number'];
  $password = $_POST['password'];
  $query = "UPDATE `users` SET Name='$name', Email='$email', Number='$number', Password='$password' WHERE Id='$id'";
  $result = mysqli_query($con, $query);
  if ($result) {
    echo "<script>alert('Updated Successfully'); 
    window.location.href='table.php';</script>";
  } else {
    echo "<script>alert('Error Updating Record');</script>";
  }
}
?>
