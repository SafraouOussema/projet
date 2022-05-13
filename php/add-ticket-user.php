  
<?php
session_start();
include_once "config.php";


if (isset($_POST['Submit'])) {
    $location = $_POST['location'];
    $status = "Waiting";
    $loginId = $_SESSION['user_id'];
 
    if (empty($location)) {

        if (empty($location)) {
            echo "<font color='red'>location field is empty.</font><br/>";
        }
         echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
      
        $result = mysqli_query($conn, "INSERT INTO tickets(status, user_id, location_id) VALUES('$status', '$loginId', '$location' )");
         echo "<font color='green'>Data added successfully.";
        header("Location: ../ticket-user.php");
    }
}


?> 
 