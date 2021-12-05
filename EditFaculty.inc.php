<?php
	include 'db.php';
	$link = connect();
	
	$firstname = $_GET['firstname'];
	$lastname = $_GET['lastname'];
	$username = $_GET['username'];
	$email = $_GET['email'];
	$password = $_GET['password'];
	
	$query = "UPDATE faculty SET FirstName = '$firstname', LastName = '$lastname', Email = '$email', Password = '$password' WHERE FacultyUsername = '$username'";
	$result = mysqli_query($link, $query);

	echo $query;

	if ($result) {
		mysqli_close($link);
		header("location: ../viewfaculty.php?");
		exit();
	} else {
		echo "Error updating record";
	}

?>