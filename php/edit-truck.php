 
<?php
  session_start();
  include_once "config.php";
 
if(isset($_POST['update'])) {	
    $id = $_POST['id'];
    $name = $_POST['name'];
    $status = $_POST['status'];
    $location = $_POST['location'];

 	
	// checking empty fields
	if(empty($name) || empty($location)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		if(  empty($location) ) {
			echo "<font color='red'>location field is empty.</font><br/>";
		}  
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
         $result = mysqli_query($conn, "UPDATE truck SET name='$name' , location_id='$location'  WHERE id=$id");

		//display success message
		echo "<font color='green'>Data added successfully.";
		header("Location: ../truck.php");

	}
}
?> 
