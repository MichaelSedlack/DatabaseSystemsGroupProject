<?php
	$dbname = 'databasedesign';
	$dbuser = 'root';
	$dbpass = '';
	$dbhost = 'localhost';

	$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
	mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");
	
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