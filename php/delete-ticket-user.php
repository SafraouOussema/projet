 
<?php 

session_start();
  include_once "config.php";

$id = $_GET['id'];

$result=mysqli_query($conn, "DELETE FROM tickets WHERE id=$id");

header("Location: ../ticket-user.php");
?>

 