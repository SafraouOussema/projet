 
<?php
  session_start();
  include_once "config.php";
 
if(isset($_POST['update'])) {	
    $id = $_POST['id'];  
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
	
        $result = mysqli_query($conn, "UPDATE location SET name='$name', cost='$cost'  WHERE id=$id");
		
		echo "<font color='green'>Data added successfully.";
		header("Location: ../location.php");

	}
}
?> 
