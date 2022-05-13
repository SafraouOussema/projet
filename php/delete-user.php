 
<?php 

session_start();
  include_once "config.php";

$id = $_GET['id'];

$result=mysqli_query($conn, "DELETE FROM users WHERE unique_id=$id");

header("Location: ../list-user.php");
?>

 