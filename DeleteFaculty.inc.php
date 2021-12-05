<?php
	include 'db.php';
	$link = connect();
	
	$username = $_GET['username'];
	$query = "DELETE FROM faculty WHERE FacultyUsername = '$username'";
	$result = mysqli_query($link, $query);

	echo $query;

	if ($result) {
		mysqli_close($conn);
		header("location: ../viewfaculty.php");
		exit();
	} else {
		echo "Error deleting record";
	}

?>