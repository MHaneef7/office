<?php   
 include('database\database.php');
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = mysqli_query($con, "DELETE FROM `users` WHERE Id = " . $id);

  if ($result) {
    echo "<script>";
    echo "alert('Delete Sucessfully');";
     echo "window.location.href = 'table.php'";
    echo "</script>";
  } else {
    echo "Error: " . mysqli_errno($con);
  }
}


?>
