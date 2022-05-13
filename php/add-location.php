  
<?php
  session_start();
  include_once "config.php";

if(isset($_POST['Submit'])) {	
	$name = $_POST['name']; 
	$cost = $_POST['cost']; 
 	
 	if(empty($name) || empty($cost)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		if(  empty($cost) ) {
			echo "<font color='red'>Cost field is empty.</font><br/>";
		}  
 		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
 			
 		$result = mysqli_query($conn, "INSERT INTO location(name, cost) VALUES('$name', '$cost')");
		
 		echo "<font color='green'>Data added successfully.";
		header("Location: ../location.php");

	}
}
?> 
