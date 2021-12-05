<?php
	include 'db.php';
	$link = connect();
	$sql = "INSERT INTO individual_forms (Class, Title, Authors, Edition, Publisher, ISBN, FormID) VALUES ('". $_POST['class']. "', '". $_POST['title']. "', '".$_POST['authors']."', ".$_POST['edition'].", '". $_POST['publisher']."', ".$_POST['isbn'].", ".$_POST['formid'].")";
	
	if(mysqli_query($link, $sql)) {
		echo "Added Book";
		header("location: ../viewform.php?semester=".$_POST['formid']);
		exit();
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}
	
	mysqli_close($link);
?>	