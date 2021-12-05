<?php
	include 'db.php';
	$link = connect();
	
	$sql = "INSERT INTO faculty (FirstName, LastName, FacultyUsername, Email, Password) VALUES ('". $_POST['firstname']. "', '". $_POST['lastname']. "', '".$_POST['username']."', '".$_POST['email']."', '". $_POST['password']."')";
	
	if(mysqli_query($link, $sql)) {
		echo "Added Faculty";
		header("location: ../viewfaculty.php");
		exit();
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}
	
	mysqli_close($link);
?>	