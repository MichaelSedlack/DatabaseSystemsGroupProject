<?php
	include 'db.php';
	$link = connect();
	
	$id = $_GET['id'];
	$query = "DELETE FROM individual_forms WHERE BookID = $id;";
	$result = mysqli_query($link, $query);

	echo $query;

	if ($result) {
		mysqli_close($conn);
		header("location: ../viewform.php?semester=".$_GET['semester']);
		exit();
	} else {
		echo "Error deleting record";
	}

?>