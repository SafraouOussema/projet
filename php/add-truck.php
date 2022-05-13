  
<?php
  session_start();
  include_once "config.php";

if (isset($_POST['Submit'])) {
	$name = $_POST['name'];
	$location = $_POST['location'];
	$status = 'Available';

	// checking empty fields
	if (empty($name) || $location === null || $location === 'chose location') {

		if (empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		if ($location === null || $location === 'chose location') {
			echo "<font color='red'>You need to chose location.</font><br/>";
		}
 		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else {
		$result = mysqli_query($conn, "INSERT INTO truck(name, status , location_id) VALUES('$name', '$status', '$location')");
 		echo "<font color='green'>Data added successfully.";
		header("Location: ../truck.php");
	}
}
 
?> 
