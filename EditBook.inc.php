<?php
	include 'db.php';
	$link = connect();
	
	$id = $_GET['id'];
	$class = $_GET['class'];
	$title = $_GET['title'];
	$authors = $_GET['authors'];
	$edition = $_GET['edition'];
	$publisher = $_GET['publisher'];
	$isbn = $_GET['isbn'];
	$semester = $_GET['semester'];
	$query = "UPDATE individual_forms SET Class = '$class', Title = '$title', Authors = '$authors', Edition = $edition, Publisher = '$publisher', ISBN = $isbn WHERE BookID = $id;";
	$result = mysqli_query($link, $query);

	echo $query;

	if ($result) {
		mysqli_close($conn);
		header("location: ../viewform.php?semester=".$semester);
		exit();
	} else {
		echo "Error updating record";
	}

?>